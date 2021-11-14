<?php

namespace Tests\Unit\Http\Requests\Kudo;

use App\Http\Requests\Kudo\UpdateRequest;
use App\Models\Kudoboards;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateRequestTest extends TestCase
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
            'description' => 'Hello World'
        ];

        return [
            
            'request should fail when description missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['description' => ''])
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
        $request = new UpdateRequest();

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
