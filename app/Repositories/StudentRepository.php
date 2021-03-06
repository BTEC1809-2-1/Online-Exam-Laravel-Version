<?php

namespace App\Repositories;
use App\User;

class StudentRepository
{
    public function getRandomUserByClass($class)
    {
        if
        (
             User::where('role', '1')
                ->where('class', $class)
                ->exists()
        )
        {
            return User::where('role', '1')
            ->where('class', $class)
            ->inRandomOrder()->limit(1)
            ->get();
        }
        return null;
    }

    public function getAllStudentByClass($class)
    {
        return User::where('role', '1')->where('class', $class)->get();
    }

    public function getStudent($id)
    {
        return User::where('role', '1')->where('email', $id)->first();
    }
}
