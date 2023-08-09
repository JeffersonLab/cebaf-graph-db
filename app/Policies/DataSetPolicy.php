<?php

namespace App\Policies;

use App\Models\DataSet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataSetPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DataSet $dataSet): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->exists();   // Any valid user
    }

    public function update(User $user, DataSet $dataSet): bool
    {
        return $user->exists();   // Any valid user
    }

    public function delete(User $user, DataSet $dataSet): bool
    {
        return $user->exists();   // Any valid user
    }

    public function restore(User $user, DataSet $dataSet): bool
    {
        return $user->exists();   // Any valid user
    }

    public function forceDelete(User $user, DataSet $dataSet): bool
    {
        return $user->exists();   // Any valid user
    }
}
