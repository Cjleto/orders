<?php

namespace App\Http\Controllers\Web;

use App\DTO\UserStoreDTO;
use App\DTO\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * @property UserService userService
 */
class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService
    ) {}

    public function index(): View
    {

        $users = $this->userService->paginate();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = $this->roleService->all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreUser $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $userStoreDTO = UserStoreDTO::fromRequest($validated);

            $user = $this->userService->store($userStoreDTO);

            Alert::alert('Success', "User {$user->name} created", 'success');
        } catch (\Exception $e) {
            Alert::alert('Error', $e->getMessage(), 'error');

            return redirect()->back();
        }

        return redirect()->route('users.index');

    }

    public function edit(User $user): View
    {
        $roles = $this->roleService->all();

        return view('users.edit', compact(['user', 'roles']));
    }

    public function update(UpdateUser $request, User $user): RedirectResponse
    {

        try {
            $validated = $request->validated();

            $userUpdateDTO = UserUpdateDTO::fromRequest($validated, $user->id);
            $user = $this->userService->update($userUpdateDTO);

            Alert::alert('Success', "User {$user->name} updated", 'success');
        } catch (\Exception $e) {
            Alert::alert('Error', $e->getMessage(), 'error');

            return redirect()->back();
        }

        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->userService->delete($user->id);

            Alert::alert('Success', "User {$user->name} deleted", 'success');
        } catch (\Exception $e) {
            Alert::alert('Error', $e->getMessage(), 'error');

            return redirect()->back();
        }

        return redirect()->route('users.index');
    }

    public function toggleTheme(): RedirectResponse
    {
        $theme = match (Auth::user()->theme) {
            'dark' => 'light',
            'light' => 'dark',
            default => 'light',
        };

        Auth::user()->theme = $theme;

        try {
            Auth::user()->save();

        } catch (\Exception $e) {

            Alert::alert('Error', $e->getMessage(), 'error');

            return redirect()->back();
        }

        return back();
    }
}
