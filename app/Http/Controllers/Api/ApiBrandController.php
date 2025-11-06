<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiBrandController extends Controller
{
    public function index()
    {
        // DB::enableQueryLog();
        $brands = DB::select("select `brands`.`id` as `brand_id`, `brands`.`name` as `brand_name`, `brands`.`slug` as `brand_slug`, `brands`.`link` as `brand_link`, `media_libraries`.`file_name` as `brand_media_name`, `media_libraries`.`alt_name` as `brand_alt_name`, `media_libraries`.`disk` as `brand_media_disk` from `brands` inner join `media_libraries` on `brands`.`logo_id` = `media_libraries`.`id` where `logo_id` is not null");
        // $brands = Brand::whereNotNull('logo_id')
        //     ->join("media_libraries", "brands.logo_id", "=", "media_libraries.id")
        //     ->select([
        //         "brands.id as brand_id",
        //         "brands.name as brand_name",
        //         "brands.slug as brand_slug",
        //         "brands.link as brand_link",
        //         "media_libraries.file_name as brand_media_name",
        //         "media_libraries.alt_name as brand_alt_name",
        //         "media_libraries.disk as brand_media_disk",
        //     ])
        // ->inRandomOrder()
        // ->orderBy('name', 'ASC')
        // ->limit(10)
        // ->get();

        // $brandss = Brand::whereNotNull('logo_id')->with('logo')
        //     ->inRandomOrder()
        //     ->orderBy('name', 'ASC')
        //     ->limit(10)
        //     ->get();

        // dd(DB::getQueryLog());

        return BrandResource::collection($brands);
    }
}
