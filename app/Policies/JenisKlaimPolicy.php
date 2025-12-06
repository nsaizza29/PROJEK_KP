<?php

namespace App\Policies;

use App\Models\JenisKlaim;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JenisKlaimPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, JenisKlaim $jenisKlaim)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, JenisKlaim $jenisKlaim)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, JenisKlaim $jenisKlaim)
    {
        return $user->isAdmin();
    }
}
