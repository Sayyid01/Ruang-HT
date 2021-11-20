<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminLoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                    ->assertSee('Login')
                    ->type('email', 'admin@pertamina.com')
                    ->type('password', 'pertamax9an@@@')
                    ->press('Login')
                    ->assertSee('Dashboard')
                    ->screenshot('image-dashboard');
        });
    }
}
