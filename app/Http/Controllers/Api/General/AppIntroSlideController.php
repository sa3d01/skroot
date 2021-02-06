<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\IntroSlidesCollectionDTO;
use App\Models\AppIntroSlide;

class AppIntroSlideController extends Controller
{
    public function index()
    {
        //return response()->json(new IntroSlidesCollectionDTO(AppIntroSlide::all()), 200);
        return new IntroSlidesCollectionDTO(AppIntroSlide::all());
    }
}
