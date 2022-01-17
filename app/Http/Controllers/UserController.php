<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Monolog\Handler\RollbarHandler;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = ['users' => User::paginate(10)];
        if ($request->has('ajax_pagination')) {
            $view = response()->view('admin.path.table.user', $data);
        } else {
            $view = view('admin.path.user', $data);
        }
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.path.user-create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'password_again' => 'required|same:password',
            'role_id' => 'required',
            'avatar_id' => 'nullable|numeric',
        ]);
        $validated['password'] = Hash::make($user['password']);
        User::create($user);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.path.user-edit', ['user' => User::find($id), 'roles' => Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'new_password' => 'nullable|min:4',
            'role_id' => 'required',
            'avatar_id' => 'nullable|numeric',
        ]);

        if (!empty($user['new_password'])) {
            $user['password'] = Hash::make($user['new_password']);
        }
        unset($user['new_password']);

        $user = User::find($id);
        if (!empty($user)) {
            $user->update($user);
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::destroy($id);
        return redirect()->route('user.index');
    }

    public function login (Request $request) {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        $rememeber = $request->input('remember');
        if (Auth::attempt($credentials, $rememeber)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}
