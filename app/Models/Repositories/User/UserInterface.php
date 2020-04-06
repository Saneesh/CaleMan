<?php

namespace App\Models\Repositories\User;

interface UserInterface
{
    /**
     * Get user by id.
     */
    public function getUserById($userId);    
}
