<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function index(User $user){
        $user = User::all();
        $data = $user;
        return json_encode($data);
    }
}
