<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{
    /**
     * Change password.
     *
     * Change the current account password.
     *
     * @param \App\Http\Requests\ChangePasswordRequest $request Validated change request.
     *
     * @return \Illuminate\Http\RedirectResponse Redirect back with success message.
     **/
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $user = User::find(auth()->id());
        $user->password = bcrypt($request->new_password);
        $user->save();

        return back()->with('message', __('Password has successfully been changed'));
    }
}
