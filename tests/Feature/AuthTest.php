<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testGuestCanRegister()
    {
        $country = Country::create([
            'name_en' => $this->faker->name(),
            'name_ar' => $this->faker->name()
        ]);
        $city = City::create([
            'name_en' => $this->faker->name(),
            'name_ar' => $this->faker->name(),
            'country_id' => $country->id,
            'delivery_fee' => $this->faker->randomFloat(2, 1, 15)
        ]);

        $requestData = [
            "name" => "Mo",
            "phone" => "+971524559806",
            "email" => $this->faker->email,
            "password" => "123456",
            "country_id" => $country->id,
            "city_id" => $city->id,
        ];
        $response = $this->post('api/v1/auth/register', $requestData);

        $response->assertStatus(200);
        $response->assertJson(["phone" => "+971524559806"]);
        $response->assertJsonStructure(['phone', 'token', 'note_ya_Jemmy']);
    }
}
