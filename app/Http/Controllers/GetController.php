<?php

namespace App\Http\Controllers;

use App\Models\User;

class GetController extends Controller
{
    //
    public function getUsers()
    {
        $users = User::all();
        return response($users);
    }
}
