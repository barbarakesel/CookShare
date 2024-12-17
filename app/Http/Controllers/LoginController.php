<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginController extends Controller
{
    public function createregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',  // password_confirmation должен совпадать с password
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        session()->flash('success', 'Вы успешно зарегистрированы!');
        return redirect()->route('profile');
    }

    public function authentication(Request $request)
    {
        // Валидация данных
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Попытка аутентификации
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        // Если не удалось авторизоваться
        return redirect()->back()->withErrors(['email' => 'Неверные данные для входа']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

}
