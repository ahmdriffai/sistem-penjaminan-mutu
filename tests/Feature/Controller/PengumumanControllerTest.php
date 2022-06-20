<?php

namespace Tests\Feature\Controller;

use App\Models\Pengumuman;
use App\Models\User;
use Database\Seeders\CreateUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PengumumanControllerTest extends TestCase
{
    use RefreshDatabase;
    private $admin;
    private $dosen;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => CreateUserSeeder::class]);

        $this->admin = User::where('name','admin')->first();
        $this->dosen = User::where('name','dosen')->first();
    }

    public function test_index_controller_admin()
    {
        Pengumuman::factory(100)->create(['judul' => 'test']);
        $this->actingAs($this->admin)
            ->get('/pengumuman')
            ->assertSuccessful();
    }
    public function test_index_controller_dosen()
    {
        $this->actingAs($this->dosen)
            ->get('/pengumuman')
            ->assertForbidden();
    }
}
