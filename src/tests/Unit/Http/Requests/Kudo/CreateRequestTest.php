<?php

namespace Tests\Unit\Http\Requests\Kudo;

use App\Http\Requests\Kudo\CreateRequest;
use App\Models\Kudoboards;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRequestTest extends TestCase
{
    use RefreshDatabase;
    protected $validator;

    public function setUp() : void
    {
        parent::setUp();

        $this->validator = app()->get('validator');
        User::factory()->create();
        Kudoboards::factory()->create();
    }

    public function requestProvider() : array
    {
        $data = [
            'user_receiver_id' => 1,
            'kudoboard_id' => 1,
            'description' => 'Hello World'
        ];

        return [
            
            'request should fail when description missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['description' => ''])
            ],
            'request should fail when user_receiver_id missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['user_receiver_id' => ''])
            ],
            'request should fail when user_receiver_id is not in database' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['user_receiver_id' => 100])
            ],
            'request should fail when kudoboard_id missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['kudoboard_id' => ''])
            ],
            'request should fail when kudoboard_id is not in database' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['kudoboard_id' => 100])
            ],
            'request should success for the rest of cases' => [
                'shouldPass' => true,
                'data' => $data
            ]
        ];
    }

    /**
     * @dataProvider requestProvider
     */
    public function test_can_validate_results_expected($shouldPass, $data)
    {
        $request = new CreateRequest();

        $this->assertEquals(
            $shouldPass,
            $this->validate( $data, $request->rules())
        );
    }


    protected function validate(array $data, array $rules)
    {
        return $this->validator
                ->make($data, $rules)
                ->passes();
    }
}
