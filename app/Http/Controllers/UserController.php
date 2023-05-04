<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listAllUsers()
    {
        return response(
            User::all(),
            200
        );
    }
}
