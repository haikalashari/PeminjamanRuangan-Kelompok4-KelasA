<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->paginate(10);
        $users = User::all();

        return view('admin.index', compact('admins', 'users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.form');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
            ]);

            Admin::create($request->all());

            return redirect()->route('admin.index')
                ->with('success', 'Admin created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('admin.index')
                ->with('error', $th->getMessage());
        }
    }

    public function show(Admin $admin)
    {
        return view('admin.detail', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.form', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin->update($request->all());

        return redirect()->route('admin.index')
            ->with('success', 'Admin updated successfully');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Admin deleted successfully');
    }
}
