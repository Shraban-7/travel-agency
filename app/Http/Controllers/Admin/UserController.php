<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User(['is_active' => true]);
        $roles = Role::where('guard_name', 'web')->orderBy('name')->pluck('name', 'name');
        $selectedRole = old('role', 'staff');

        return view('admin.users.form', compact('user', 'roles', 'selectedRole'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => $data['password'],
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        $user->syncRoles([$data['role']]);

        activity()
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties(['name' => $user->name, 'email' => $user->email, 'role' => $data['role']])
            ->log('Staff user created: '.$user->email);

        return redirect()->route('admin.users.index')->with('success', __('User created.'));
    }

    public function edit(User $user)
    {
        $roles = Role::where('guard_name', 'web')->orderBy('name')->pluck('name', 'name');
        $selectedRole = old('role', $user->roles->first()?->name ?? 'staff');

        return view('admin.users.form', compact('user', 'roles', 'selectedRole'));
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
            ...(filled($data['password'] ?? null) ? ['password' => $data['password']] : []),
        ]);

        $user->syncRoles([$data['role']]);

        return back()->with('success', __('User updated.'));
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', __('You cannot delete your own account.'));
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('User deleted.'));
    }
}
