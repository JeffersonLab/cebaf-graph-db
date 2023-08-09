<?php

namespace App\Policies;

use App\Models\Config;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Config $config): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->exists();   // Any valid user
    }

    public function update(User $user, Config $config): bool
    {
        return $user->exists();   // Any valid user
    }

    public function delete(User $user, Config $config): bool
    {
        return $user->exists();   // Any valid user
    }

    public function restore(User $user, Config $config): bool
    {
        return $user->exists();   // Any valid user
    }

    public function forceDelete(User $user, Config $config): bool
    {
        return $user->exists();   // Any valid user
    }
}
