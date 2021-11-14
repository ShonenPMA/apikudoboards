<?php

namespace Tests\Unit\Http\Requests\Project;

use App\Http\Requests\Project\UpdateRequest;
use Tests\TestCase;

class UpdateRequestTest extends TestCase
{
    protected $validator;

    public function setUp() : void
    {
        parent::setUp();

        $this->validator = app()->get('validator');
    }

    public function requestProvider() : array
    {
        $data = [
            'name' => 'Taka'
        ];

        return [
            'request should fail when name missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['name' => ''])
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
