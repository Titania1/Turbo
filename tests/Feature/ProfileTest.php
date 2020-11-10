<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Profile;
use App\User;
use Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    private object $user;
    private object $profile;

    public function setUp(): void
    {
        parent::setUp();
        Storage::disk('public')->deleteDirectory('avatars');
        Storage::disk('public')->makeDirectory('avatars');
        $this->user = create(User::class);
        $this->profile = create(Profile::class, [
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * Test profile.
     */
    public function testProfileAvatar(): void
    {
        // Create a profile and set the user id to the user in the constructor
        $this->profile->addMedia(storage_path('app/public/'.$this->profile->avatar))
            ->toMediaCollection();
        $this->assertNotEquals('/images/avatar.png', $this->user->avatar);
        $this->assertNotEquals('/images/avatar.png', $this->user->accountMenuAvatar);
    }

    public function testUserRelationship(): void
    {
        $user = $this->profile->user;
        $this->assertInstanceOf(User::class, $user);
    }
}
