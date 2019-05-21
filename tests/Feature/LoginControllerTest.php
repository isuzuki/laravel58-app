<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var App\User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function ログインに成功すること()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     */
    public function ログアウトに成功する()
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/logout');

        $response
            ->assertStatus(302)
            ->assertRedirect('/');
        $this->assertGuest();
    }
}
