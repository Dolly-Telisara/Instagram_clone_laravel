<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct() //If the user is not loggedIn he should not be able to follow or unfollow profile & show unauthorized
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
