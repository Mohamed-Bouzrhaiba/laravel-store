<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;

class BrandPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Brand $brand): bool
    {
        return $user->id === $brand->user_id;
    }
    public function delete(User $user, Brand $brand): bool
    {
        return $user->id === $brand->user_id;
    }
}
