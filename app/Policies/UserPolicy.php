<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        // Superadmin bebas (CRUD user)
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, User $model)
    {
        return true;
    }

    public function create(User $user)
    {
        // Hanya super_admin boleh buat, maka return false.
        return false;
    }

    public function update(User $user, User $model)
    {
        // User boleh update profilnya sendiri
        return $user->id === $model->id;
    }

    public function delete(User $user, User $model)
    {
        // Hanya super_admin (masuk di before), maka default false.
        return false;
    }

    public function approve(User $user, User $model)
    {
        // Hanya super_admin (masuk di before), maka default false.
        return false;
    }
}
