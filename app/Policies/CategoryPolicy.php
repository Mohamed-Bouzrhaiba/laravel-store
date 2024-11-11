<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Category $category): bool
    {

        return $user->id === $category->user_id;
    }
    public function delete(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }
}
