<?php

namespace App\Policies;

use App\Models\CulturalExploration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CulturalExplorationPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor', 'author']);
    }

    public function view(User $user, CulturalExploration $model): bool
    {
        return in_array($user->role, ['admin', 'editor', 'author']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor', 'author']);
    }

    public function update(User $user, CulturalExploration $model): bool
    {
        return in_array($user->role, ['admin', 'editor']) || $user->id === $model->user_id;
    }

    public function delete(User $user, CulturalExploration $model): bool
    {
        return in_array($user->role, ['admin', 'editor']) || $user->id === $model->user_id;
    }

    public function restore(User $user, CulturalExploration $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function forceDelete(User $user, CulturalExploration $model): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }
}