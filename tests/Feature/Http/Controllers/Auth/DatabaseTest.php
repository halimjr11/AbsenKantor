<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class DatabaseTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_table_database_record()
    {
        $this->assertDatabaseHas('users', [
            'email' => "admin@gmail.com",
            'name' => "Nurhaq Halim",
            'level'=> "admin"
        ]);
    }
    public function test_table_database_divisi_record()
    {
        $this->assertDatabaseHas('divisis', [
            'id_divisi' => "2",
            'nama' => "Tata Usaha"
        ]);
    }
    public function test_table_table()
    {
        $this->assertDatabaseHas('users',[]);
    }
}
