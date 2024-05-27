<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.detail', compact('user'));
    }

    public function update(Request $request)
    {
        try {
            if($request->password) {
                if(Hash::check($request->password, Auth::user()->password)) {
                    if($request->newpassword == $request->renewpassword) {
                        Auth::user()->update([
                            'password' => Hash::make($request->newpassword)
                        ]);

                        return redirect()->back()->with('success', 'Password berhasil diupdate');


                    } else {
                        return redirect()->back()->with('error', 'Password baru tidak sama dengan konfirmasi password');
                    }
                } else {
                    return redirect()->back()->with('error', 'Password lama tidak sesuai');
                }
            } else {
                // validate request
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email'
                ]);

                Auth::user()->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
                
                return redirect()->back()->with('success', 'Profile berhasil diupdate');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
