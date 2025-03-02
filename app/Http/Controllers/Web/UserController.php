<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\DTO\UserStoreDTO;
use App\DTO\UserUpdateDTO;
use App\Services\RoleService;
use App\Services\UserService;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * @property UserService userService
 */

class UserController extends Controller
{

    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService
    ){}

    public function index()
    {

        $users = $this->userService->paginate();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleService->all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreUser $request){
        try
        {
            $validated = $request->validated();

            $userStoreDTO = new UserStoreDTO(
                name: $validated['name'],
                email: $validated['email'],
                password: $validated['password'],
                role: $validated['role']
            );

            $user = $this->userService->store($userStoreDTO);

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
        $roles = $this->roleService->all();
        return view('users.edit', compact(['user','roles']));
    }

    public function update(UpdateUser $request, User $user)
    {

        try
        {
            $validated = $request->validated();

            $userUpdateDTO = UserUpdateDTO::fromRequest($validated, $user->id);
            $user = $this->userService->update($userUpdateDTO);


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
