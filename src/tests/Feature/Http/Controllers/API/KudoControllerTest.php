<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Exceptions\Kudo\KudoboardException;
use App\Exceptions\Kudo\OnlySender;
use App\Exceptions\Kudo\ReceiverException;
use App\Models\Kudo;
use App\Models\Kudoboards;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class KudoControllerTest extends TestCase
{
    use RefreshDatabase;
    const PATH = 'api/kudo';
    private $user;
    public function setUp() : void
    {
        parent::setUp();

        $this->user =User::factory()->create();
        Sanctum::actingAs(
            $this->user
        );
    }

    public function test_can_register_kudo()
    {
        $receiver = User::factory()->create();
        $data = [
            'description' => 'Taka',
            'user_receiver_id' => $receiver->id,
            'kudoboard_id' => $receiver->kudoboards()->first()->id
        ];
        
        $response = $this->json('POST', self::PATH, $data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('kudos', [
            'description' => $data['description']
        ]);
    }

    public function test_can_not_register_kudo_if_the_receiver_is_the_auth_user()
    {
        $data = [
            'description' => 'Taka',
            'user_receiver_id' => $this->user->id,
            'kudoboard_id' => $this->user->kudoboards()->first()->id
        ];
        
        $this->withoutExceptionHandling();
        $this->expectException(ReceiverException::class);
        $this->json('POST', self::PATH, $data)->dump();
    }
    public function test_can_not_register_kudo_if_kudoboard_does_not_belong_to_sender_or_receiver()
    {
        $receiver = User::factory()->create();
        $data = [
            'description' => 'Taka',
            'user_receiver_id' => $receiver->id,
            'kudoboard_id' => Kudoboards::factory()
        ];
        
        $this->withoutExceptionHandling();
        $this->expectException(KudoboardException::class);
        $this->json('POST', self::PATH, $data)->dump();
    }


    public function test_can_update_kudo()
    {
        $kudo = Kudo::factory()->create([
            'user_sender_id' => $this->user->id
        ]);
        $data = [
            'description' => 'Taka',
        ];
        
        $response = $this->json('PUT', self::PATH . "/{$kudo->id}", $data);

        $response->assertStatus(Response::HTTP_OK);
    }
    public function test_can_update_kudo_only_the_sender()
    {
        $kudo = Kudo::factory()->create();
        $data = [
            'description' => 'Taka',
        ];
        $this->withoutExceptionHandling();
        $this->expectException(OnlySender::class);
        $this->json('PUT', self::PATH . "/{$kudo->id}", $data);

    }

}
