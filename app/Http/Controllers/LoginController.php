<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use Auth;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {

        $userc = Users::select('role_id','flag_pass','flag_prof','users.id')
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where('users.username', $request->username)
        ->first();

        // Attempt Login for members
        if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {

            $msg = array(
                'role' => $userc->role_id,
                'status' => 'success',
                'id' => $userc->id,
                'flag_pass' => $userc->flag_pass,
                'flag_prof' => $userc->flag_prof
            );

            return response()->json($msg);

        } else {

            $msg = array(
                'status'  => 'error',
            );

            return response()->json($msg);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        return redirect()->guest(route('login.user'));
    }

    public function showLoginForm()
    {

        return view('login.index');
    }
}
