<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HalamanAssignHTTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHalamanAlamatAssignHT()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->assertSee('Login')
                ->type('email', 'admin@pertamina.com')
                ->type('password', 'pertamax9an@@@')
                ->press('Login')
                ->assertSee('Dashboard')
                ->visit('/assignHtLokasi')
                ->assertSee('Lokasi Assign HT')
                ->visit('/assignHtAlamat?lokasi=3')
                ->assertSee('Alamat Assign HT')
                ->screenshot('image-alamatAssign');
        });
    }
}
