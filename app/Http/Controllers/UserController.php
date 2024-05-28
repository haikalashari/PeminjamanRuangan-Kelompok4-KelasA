<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.detail', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            if($request->password) {
                DB::beginTransaction();

                if(Hash::check($request->password, Auth::user()->password)) {
                    if($request->newpassword == $request->renewpassword) {
                        $user->password = Hash::make($request->newpassword);
                        $user->save();

                        DB::commit();

                        return redirect()->back()->with('success', 'Password berhasil diupdate');


                    } else {
                        return redirect()->back()->with('error', 'Password baru tidak sama dengan konfirmasi password');
                    }
                } else {
                    return redirect()->back()->with('error', 'Password lama tidak sesuai');
                }
            } else {
                DB::beginTransaction();


                $user->name = $request->name;
                $user->email = $request->email;
                $user->nim = $request->nim;
                $user->save();

                if(!$user->mahasiswa) {
                    Mahasiswa::create([
                        'nim' => $request->nim,
                        'user_id' => Auth::id(),
                    ]);
                }

                DB::commit();
                
                return redirect()->back()->with('success', 'Profile berhasil diupdate');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
