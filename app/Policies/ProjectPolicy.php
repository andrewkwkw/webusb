<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function view(User $user, Project $model): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Project $model): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Project $model): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Project $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function forceDelete(User $user, Project $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }
}