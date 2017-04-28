<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AjaxOnlyRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware(AjaxOnlyRequest::class);
    }

    public function current()
    {
        $data = [];
        if (Auth::check())
            $data = Auth::user()->toArray();
        return ['loggedIn' => Auth::check(), 'user' => $data];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|max:255',
            'password' => 'required|min:4|max:16',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false], 400);
        }
        $login = [
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];
        if (Auth::attempt($login)) {
            return ['success' => true, 'user' => Auth::user()->toArray()];
        } else {
            return ['success' => false];
        }
    }

    public function logout()
    {
        Auth::logout();
    }

    public function register()
    {

    }
}
