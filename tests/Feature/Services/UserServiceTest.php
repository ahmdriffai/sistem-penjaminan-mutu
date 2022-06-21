<?php

namespace Tests\Feature\Services;

use App\Http\Requests\UserAddRequest;
use App\Models\Dosen;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function test_provider()
    {
        self::assertTrue(true);
    }

    public function test_add_user_success()
    {
        $dosen = Dosen::factory()->create();
        $request = new UserAddRequest([
            'dosen_id' => $dosen->id,
            'email' => $this->faker->email,
            'roles' => []
        ]);

        $result = $this->userService->add($request, $dosen->nidn);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('dosen', 1);

        $user = User::find($result->id);

        self::assertTrue(Hash::check($result->password, $user->password));
    }

    public function test_list_user()
    {
        User::factory(20)->create();

        $list = $this->userService->list();

        self::assertSame(10, $list->count());

        $list = $this->userService->list('salah');

        self::assertSame(0 , $list->count());

        $list = $this->userService->list('', 5);

        self::assertSame(5 , $list->count());

    }

    public function test_update_user_succes()
    {
        $this->markTestSkipped('malas test.');
    }

    public function test_delete_user_succes()
    {
        $user = User::factory()->create();
        $this->assertDatabaseCount('users', 1);
        $this->userService->delete($user->id);
        $this->assertDatabaseCount('users', 0);
    }


}
