<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AssignHtTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    

    public function testAssignHT()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                    ->assertSee('Login')
                    ->type('email', 'admin@pertamina.com')
                    ->type('password', 'pertamax9an@@@')
                    ->press('Login')
                    ->visit('/assignHtLokasi')
                    ->assertSee('Lokasi Assign HT')
                    ->visit('/assignHtAlamat?lokasi=3')
                    ->assertSee('Alamat Assign HT')
                    ->visit('/assignHt?alamat=1')
                    ->assertSee('Assign HT')
                    ->screenshot('image-AssignHT');
        });
    }
}
