<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->username = $request->username;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }

    public function block($id)
    {
        $user = User::find($id);
        $user->role = 3;
        $user->save();

        return redirect()->route('admin.produk.index')->with('success', 'User blocked successfully');
    }

    public function unblock($id)
    {
        $user = User::find($id);
        $user->role = 1;
        $user->save();

        return redirect()->route('admin.produk.index')->with('success', 'User unblocked successfully');
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Profile deleted successfully');
    }
    public function incrementPurchases(User $user, $quantity)
    {
        $user->purchases += $quantity;
        $user->save();
    }

}
