<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
use RealRashid\SweetAlert\Facades\Alert;



class UserController extends Controller
{
    public function index()
    {

        $users = User::with('company')->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreUser $request){
        try
        {
            $validated = $request->validated();
            unset($validated['role']);

            $user = User::create($validated);
            $user->assignRole(request('role'));


            Alert::alert('Success', "User {$user->name} created", 'success');
        }
        catch(\Exception $e)
        {
            Alert::alert('Error', $e->getMessage(), 'error');
            return redirect()->back();
        }

        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact(['user','roles']));
    }

    public function update(UpdateUser $request, User $user)
    {

        try
        {
            $validated = $request->validated();
            unset($validated['role']);

            $user->update($validated);
            $user->syncRoles(request('role'));
            Alert::alert('Success', "User {$user->name} updated", 'success');
        }
        catch(\Exception $e)
        {
            Alert::alert('Error', $e->getMessage(), 'error');
            return redirect()->back();
        }

        return redirect()->route('users.index');
    }

    public function toggleTheme() {
        $theme = match(Auth::user()->theme) {
            'dark' => 'light',
            'light' => 'dark',
            default => 'light',
        };


        Auth::user()->theme = $theme;

        try{
            Auth::user()->save();

        } catch(\Exception $e)
        {

            Alert::alert('Error', $e->getMessage(), 'error');
            return redirect()->back();
        }

        return back();
    }
}
