<?php

namespace Tests\Unit\Http\Requests\ProjectUser;

use App\Http\Requests\ProjectUser\CreateRequest;
use App\Models\Project;
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
        Project::factory()->create();
    }

    public function requestProvider() : array
    {
        $data = [
            'user_id' => 1,
            'project_id' => 1,
        ];

        return [
            'request should fail when user_id missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['user_id' => ''])
            ],
            'request should fail when user_id is not in database' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['user_id' => 100])
            ],
            'request should fail when project_id missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['project_id' => ''])
            ],
            'request should fail when project_id is not in database' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['project_id' => 100])
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
