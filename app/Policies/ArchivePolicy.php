<?php

namespace App\Policies;

use App\Models\Archive;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArchivePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function view(User $user, Archive $model): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Archive $model): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Archive $model): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Archive $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function forceDelete(User $user, Archive $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }
}