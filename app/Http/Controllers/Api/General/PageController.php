<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Enums\StaticPageLabels;
use App\Http\Resources\General\StaticPageDTO;
use App\Imports\CarBrandsImport;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Excel;

class PageController extends Controller
{
//    public function uploadExcel(Request $request){
//        ini_set('memory_limit', '-1');
//        ini_set('set_time_limit', '6000');
//        ini_set('max_execution_time', '6000');
//        Excel::import(new CarBrandsImport, $request->file('excel'));
//        return redirect('/')->with('success', 'All good!');
//    }

    public function terms()
    {
        $page = StaticPage::where("label", StaticPageLabels::TERMS)->first();
        if (!$page) {
            abort(404, "Page not found.");
        }
        return response()->json(new StaticPageDTO($page), 200);
    }

    public function privacy()
    {
        $page = StaticPage::where("label", StaticPageLabels::PRIVACY)->first();
        if (!$page) {
            abort(404, "Page not found.");
        }
        return response()->json(new StaticPageDTO($page), 200);
    }
}
