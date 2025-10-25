<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): View
    {
        $userCount = User::count();
        $orderCount = Order::count();
        $reviewCount = Review ::count();

        return view('admin.dashboard', compact('userCount', 'orderCount', 'reviewCount'));
    }

    public function login(): View
    {
        return view('admin.login');
    }

    public function auth(Object $request) : RedirectResponse
    {
        if(auth()->guard('admin')->attempt($request->validated())) {
            $request->session()->regenerate();
            return to_route('admin.index');
        }else {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.'
            ])->onlyInput('email');
        }
    }
}
