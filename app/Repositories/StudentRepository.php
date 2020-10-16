<?php

namespace App\Repositories;
use App\User;

class StudentRepository
{
    public function getRandomUserByClass($class)
    {
        return User::where('role', '1')
                ->where('class', $class)
                ->get()
                ->random(1);
    }
}
