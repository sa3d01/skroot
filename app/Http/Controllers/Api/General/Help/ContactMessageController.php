<?php

namespace App\Http\Controllers\Api\General\Help;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Help\ContactMessageStoreRequest;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function store(ContactMessageStoreRequest $request)
    {
        $data = $request->validated();
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }
        ContactMessage::create($data);
        return response()->json(null, 200);
    }
}
