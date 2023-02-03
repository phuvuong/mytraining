<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        // $category = CategoryProduct::all();
        // dd($category);
        $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id','DESC')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','DESC')->get();
        return view('pages.home')->with('category',$cate_product)->with('brand_product',$brand_product);
   }
}
