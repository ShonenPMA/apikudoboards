<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\EditProfileRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProfileRequestTest extends TestCase
{
    use RefreshDatabase;
    protected $validator;

    public function setUp() : void
    {
        parent::setUp();

        $this->validator = app()->get('validator');
        
    }

    public function requestProvider() : array
    {
        $data = [
            'name' => 'shonen',
            'email' => 'shonen@example.test',
            'birth_date' => '1990-01-01',
            'password' => '123456Aa*',
            'password_confirmation' => '123456Aa*'
        ];

        return [
            'request should fail when name missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['name' => ''])
            ],
            'request should fail when email missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['email' => ''])
            ],
            'request should fail when email has wrong format' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['email' => 'testemail'])
            ],
            'request should fail when birth_date missing' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['birth_date' => ''])
            ],
            'request should fail when birth_date has wrong format' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['birth_date' => '01-01-1990'])
            ],
            'request should fail when birth_date is less than 18 years before' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['birth_date' => '2005-01-01'])
            ],
            'request should fail when password not contains at least one number' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['password' => 'passwordTest*'])
            ],
            'request should fail when password not contains at least one uppercase letter' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['password' => 'passwordtest*1'])
            ],
            'request should fail when password not contains at least one lowercase letter' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['password' => 'PASSWORDTEST*1'])
            ],
            'request should fail when password not contains at least one special character' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['password' => 'PASSWORDTESTx1'])
            ],
            'request should fail when password not contains minimun eight characters' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['password' => 'pA$w1'])
            ],
            'request should fail when password_confirmation not match' => [
                'shouldPass' => false,
                'data' => array_merge($data, ['password_confirmation' => 'pA$w1'])
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
        $request = new EditProfileRequest();

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
