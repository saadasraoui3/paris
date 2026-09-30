<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login.login'); // صفحة login dyal admin
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // محاولة تسجيل الدخول
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard'); // dashboard dyal admin
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
    }

    public function logout(Request $request)
{
    Auth::guard('admin')->logout();       // تسجيل الخروج
    $request->session()->invalidate();     // إبطال السيشن
    $request->session()->regenerateToken(); // تجديد CSRF token

    return redirect()->route('admin.login'); // إعادة التوجيه لصفحة login
}


    public function dashboard()
{
    if (!Auth::guard('admin')->check()) {
        return redirect()->route('admin.login');
    }

    $products = Product::with('productColors.images')->orderBy('created_at', 'desc')->paginate(5);
    $orders   = Order::orderBy('created_at', 'desc')->paginate(8);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $totals = [];

    foreach(range(1,12) as $m){
        $totals[] = \App\Models\Order::whereMonth('created_at', $m)->sum('total');
    }

    $salesData = ['months' => $months, 'totals' => $totals];

    return view('admin.dashboard.dashboard', compact('products', 'orders', 'salesData'));
}

}
