<?php

namespace App\Policies;

use App\Models\Artwork;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArtworkPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor', 'author']);
    }

    public function view(User $user, Artwork $model): bool
    {
        return in_array($user->role, ['admin', 'editor', 'author']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor', 'author']);
    }

    public function update(User $user, Artwork $model): bool
    {
        return in_array($user->role, ['admin', 'editor']) || $user->id === $model->user_id;
    }

    public function delete(User $user, Artwork $model): bool
    {
        return in_array($user->role, ['admin', 'editor']) || $user->id === $model->user_id;
    }

    public function restore(User $user, Artwork $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function forceDelete(User $user, Artwork $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }
}