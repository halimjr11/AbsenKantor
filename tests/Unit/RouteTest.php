<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Landing_Page()
    {
        $this->get("/test")->assertStatus(200);//test routing benar adanya
    }
    public function test_registrasi_pegawai()
    {
        $response = $this->get('/pegawai/tambah');

        $response->assertStatus(302);//routing form tambah pegawai
    }
    public function test_Absensi()
    {
        $this->get("/absensi")->assertStatus(302);//test routing absensi
    }
}
