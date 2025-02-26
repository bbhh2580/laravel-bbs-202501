<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display the user's profile page
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user): Factory|View|Application
    {
        return view('users.show', compact('user'));
    }

    /**
     * Display the user's edit form.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user): Factory|View|Application
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     *
     * @param UserRequest $request
     * @param ImageUploadHandler $uploader
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user): RedirectResponse
    {
        $data = $request->all();
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', 'Profile updated successfully.');
    }
}
