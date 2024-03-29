<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(): View
    {
        return view('profile.form', [
            'user' => $this->userRepository->getUser(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest $request
     *
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $this->userRepository->updateUser(
            $request->only([
                'name',
                'email',
                'password',
            ])
        );

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente');
    }
}
