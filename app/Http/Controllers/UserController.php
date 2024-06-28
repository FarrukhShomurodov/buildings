<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->orderBy('id')->get();
        return view('users', compact('users'));
    }

    public function create(): view
    {
        return view('users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {

        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        User::query()->create($validated);

        return redirect()->route('users.index');
    }

    public function show(User $user): view
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): view
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        $user->update($request->except('password'));
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
