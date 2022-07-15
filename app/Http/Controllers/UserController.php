<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.form', [
            'user' => $this->userRepository->getUserById(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $userData = $request->only([
            'name',
            'email',
            'password',
        ]);
        $this->userRepository->updateUser($userData);
        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente');
    }
}
