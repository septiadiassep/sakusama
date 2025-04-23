<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserModel::all();
        return view('user.user_index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ]);

            $user = new UserModel();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = bcrypt($request->input('password')); 
            // $user->email_verified_at = Carbon::now();
            // $user->remember_token = \Illuminate\Support\Str::random(10);
            $user->save();

            return redirect()->route('user.index')->with('success', 'Data user berhasil disimpan!');
        } catch (\Throwable $e) {
            return redirect()->route('user.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('user.user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6', // Password boleh kosong
        ]);

        try {
            $user = UserModel::findOrFail($id);

            $user->name = $validated['name'];
            $user->email = $validated['email'];

            if (!empty($validated['password'])) {
                $user->password = bcrypt($request->input('password')); 
            }
            $user->save();

            return redirect()->route('user.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UserModel::findOrFail($id)->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
