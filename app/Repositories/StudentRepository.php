<?php

namespace App\Repositories;
use App\User;

class StudentRepository
{
    public function getRandomUserByClass($class)
    {
        $student = User::where('role', '1')
        ->where('class', $class)
        ->inRandomOrder()->limit(5)
        ->get();
        return $student ?: (object)[];
    }
    public function getAllUserByClass($class)
    {
        return User::where('role', '1')
            ->where('class', $class)
            ->get();
    }
}
