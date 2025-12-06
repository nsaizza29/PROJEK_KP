<?php

namespace App\Policies;

use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NasabahPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        // Superadmin bebas semua
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        // Semua role bisa viewAny
        return true;
    }

    public function view(User $user, Nasabah $nasabah)
    {
        // Admin boleh semua, Petugas hanya jika dia pegang
        return $user->isAdmin() || ($user->isPetugas() && $nasabah->petugas_id == $user->id);
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Nasabah $nasabah)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Nasabah $nasabah)
    {
        return $user->isAdmin();
    }

    // Pemeriksaan action checklist (centang & silang): boleh oleh admin (semua nasabah), atau petugas hanya miliknya sendiri
    public function checklist(User $user, Nasabah $nasabah)
    {
        return $user->isAdmin() || ($user->isPetugas() && $nasabah->petugas_id == $user->id);
    }
}

