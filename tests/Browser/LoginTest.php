<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testSuccess(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::factory()->create();
            
            $browser->visit('/login')
            ->type('email', $user->email)
            ->type('password', 'password')
            ->press('ログイン')
            ->assertPathIs('/tweet')
            ->assertSee('Laravel');
        });
    }
}
