<?php

namespace App\Http\Resources\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerLoginDTO extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $tokenResult = $this->createToken('customer');
        $tokenResult->token->expires_at = Carbon::now()->addWeeks(1);

        return [
            "user" => [
                'id' => (int)$this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone ?? "",
                'country' => [
                    'id' => $this->country ? (int)$this->country->id : 0,
                    'name_en' => $this->country ? $this->country->translate('en')->name : "",
                    'name_ar' => $this->country ? $this->country->translate('ar')->name : "",
                ],
                'city' => [
                    'id' => $this->city ? (int)$this->city->id : 0,
                    'name_en' => $this->city ? $this->city->translate('en')->name : "",
                    'name_ar' => $this->city ? $this->city->translate('ar')->name : "",
                ],
                'bio' => $this->bio ?? "",
                'avatar_url' => $this->avatar_url,
            ],

            "settings" => [
                //'is_completed_profile' => $this->is_completed_profile,
                'banned' => (boolean)$this->banned,
                'locale' => $this->locale,
                'notification_toggle' => (boolean)$this->notification_toggle,
            ],

            "access_token" => [
                'token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ],

        ];
    }
}
