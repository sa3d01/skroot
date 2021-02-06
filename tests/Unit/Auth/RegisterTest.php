<?php

namespace Tests\Unit\Auth;

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Requests\Api\Auth\UserRegistrationRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;
use Mockery;

class RegisterTest extends TestCase
{
    use WithFaker;

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGuestRegisterSuccessfully()
    {

        //$country = factory(Country::class)->make();

        // dd($country);

        $country = Country::create([
            'name_en' => "gg",
            'name_ar' => "gg"
        ]);
        $city = City::create([
            'name_en' => "gg",
            'name_ar' => "gg",
            'country_id' => $country->id,
            'delivery_fee' => 12.4
        ]);


//        UserRegistrationRequest::shouldReceive('validated')->once()->andReturn($requestParams);

//        $mock = Mockery::mock(UserRegistrationRequest::class);
//        $mock->shouldReceive('validated')->once()->andReturn($requestParams);

//        $mock = Mockery::mock('App\Contracts\Repositories\Document');
//        $mock->shouldReceive('create')->with([
//            'title' => 'foo',
//            'text' => 'bar',
//        ])->once()->andReturn(true);

        $faker = Factory::create();

        $requestParams = [
            "name" => "Mo",
            "phone" => $faker->unique()->e164PhoneNumber,
            "email" => $faker->unique()->email,
            "password" => "123456",
            "country_id" => $country->id,
            "city_id" => $city->id
        ];
        $request = UserRegistrationRequest::create("uurrll", "POST", $requestParams);
        $request->setMethod("POST");
        $request->query->add($requestParams);
        $request->attributes->add($requestParams);
        $request->setContainer(app());
        //$request->setRedirector(app(\Illuminate\Routing\Redirector::class))
        $request->validateResolved();

        $controller = new RegisterController();
        $response = $controller->register($request);

        $this->assertTrue(true);
        $this->assertEquals($requestParams['phone'], $response->getData()->phone);
    }
}
