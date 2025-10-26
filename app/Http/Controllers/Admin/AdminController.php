<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function auth(AuthAdminRequest $request) : RedirectResponse
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
    public function logout(Request $request) : RedirectResponse
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('admin.login');
    }
}
