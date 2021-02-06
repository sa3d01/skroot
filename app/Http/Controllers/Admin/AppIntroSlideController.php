<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\AppIntroSlideStoreRequest;
use App\Http\Requests\Admin\Setting\AppIntroSlideUpdateRequest;
use App\Models\AppIntroSlide;
use Illuminate\Support\Facades\DB;

class AppIntroSlideController extends Controller
{
    public function index()
    {
        return view('admin.app-intro-slides.index')
            ->with('slides', AppIntroSlide::orderBy('order', 'asc')->paginate())
            ->with('total', AppIntroSlide::count());
    }

    public function create()
    {
        return view('admin.app-intro-slides.create');
    }

    public function store(AppIntroSlideStoreRequest $request)
    {
        AppIntroSlide::create($request->validated());
        return redirect()->route('admin.app-intro-slides.index')
            ->with('title', __("Added successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function show(AppIntroSlide $slide)
    {
        return redirect()->route('admin.app-intro-slides.edit', $slide['id']);
    }

    public function edit(AppIntroSlide $slide)
    {
        return view('admin.app-intro-slides.edit')
            ->with('slide', $slide);
    }

    public function moveUp(AppIntroSlide $slide)
    {
        $currentOrder = $slide->order;
        if ($currentOrder != 1) {
            $toBeDownSlide = AppIntroSlide::where('order', '<', $currentOrder)->orderBy('order', 'desc')->first();
            DB::transaction(function () use ($slide, $toBeDownSlide, $currentOrder) {
                $slide->update(['order' => $toBeDownSlide->order]);
                $toBeDownSlide->update(['order' => $currentOrder]);
            });
        }
        return redirect()->back();
    }

    public function moveDown(AppIntroSlide $slide)
    {
        $currentOrder = $slide->order;
        $slidesCount = AppIntroSlide::count();
        if ($currentOrder != $slidesCount) {
            $toBeUpSlide = AppIntroSlide::where('order', '>', $currentOrder)->orderBy('order', 'asc')->first();
            DB::transaction(function () use ($slide, $toBeUpSlide, $currentOrder) {
                $slide->update(['order' => $toBeUpSlide->order]);
                $toBeUpSlide->update(['order' => $currentOrder]);
            });
        }
        return redirect()->back();
    }

    public function update(AppIntroSlideUpdateRequest $request, AppIntroSlide $slide)
    {
        $slide->update($request->validated());
        return redirect()->route('admin.app-intro-slides.index')
            ->with('title', __("Updated successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function destroy(AppIntroSlide $slide)
    {
        $slide->delete();
        return redirect()->route('admin.app-intro-slides.index')
            ->with('title', __("Deleted successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }
}
