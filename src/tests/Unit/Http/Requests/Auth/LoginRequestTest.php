<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Tests\TestCase;

class LoginRequestTest extends TestCase
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
            'email' => 'shonen@example.test',
            'password' => '123456Aa*',
        ];

        return [
            'request should fail when email missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['email' => ''])
            ],
            'request should fail when password missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['password' => ''])
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
        $request = new LoginRequest();

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
