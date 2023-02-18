<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = User::all();

        return inertia('User/Index', [
            'users' => UserResource::collection($users)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return inertia('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        dd($request->all());

        User::create($request->validated());

        return redirect()->route('users.index')->with('success', __('users.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        return inertia('User/Show', [
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Response
    {
        return inertia('User/Edit', [
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id): RedirectResponse
    {
        dd($request->all());

        $user = $user->update($request->validated());

        return redirect()->route('users.edit', $user)->with('success', __('users.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', __('users.deleted'));
    }
}
