<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class RecoveryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
        // $this->middleware('throttle:1,60', ['except' => 'showLinkRequestForm']);
    }

    public function index()
    {
        return view('auth.recovery');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['mensaje' => __($status)])
                : back()->with(['mensaje' => __($status)]);
                // : back()->withErrors(['email' => __($status)]);
        
    }
}
