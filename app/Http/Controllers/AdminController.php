<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (isset(Auth::user()->is_admin) && !Auth::user()->is_admin) {
            return redirect()->back();
        }
        return view('admin.index');
    }
}
