<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of users.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->isSuperAdmin()) {
            $pendingUsers = User::where('is_approved', false)->paginate(8);
            $users = User::where('is_approved', true)->orderBy('created_at', 'desc')->paginate(10);
            return view('users.index', compact('users', 'pendingUsers'));
        }
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nip' => 'nullable|string|unique:users',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'role' => 'required|in:admin,petugas',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'nip' => ['nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'role' => 'required|in:admin,petugas',
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function approve(User $user)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        $user->update(['is_approved' => true]);
        return redirect()->route('users.index')->with('success', 'User berhasil diapprove.');
    }

    /**
     * Download data users to CSV
     */
    public function download()
    {
        $this->authorize('create', User::class); // Only admin can download
        
        $users = User::orderBy('created_at', 'desc')->get();
        
        // Create CSV
        return new StreamedResponse(function() use ($users) {
            $handle = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 support
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($handle, ['No', 'Nama', 'Email', 'NIP', 'Alamat', 'No HP', 'Role']);
            
            // Data
            $no = 1;
            foreach ($users as $user) {
                fputcsv($handle, [
                    $no++,
                    $user->name,
                    $user->email,
                    $user->nip ?? '-',
                    $user->alamat ?? '-',
                    $user->no_hp ?? '-',
                    ucfirst($user->role)
                ]);
            }
            
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Data_User_'.date('Y-m-d').'.csv"',
        ]);
    }
}
