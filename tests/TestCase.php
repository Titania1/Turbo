<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Set the currently logged in user for the application.
     *
     * @param Illuminate\Contracts\Auth\Authenticatable
     *
     * @return App\User authenticated
     */
    protected function login($user = null)
    {
        $user = $user ?: create(User::class);
        $this->be($user);

        return $this;
    }
}
