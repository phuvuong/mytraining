<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\CategoryProduct;
use App\Brand;
use App\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id','DESC')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','DESC')->get();
        return view('product.add')->with('category',$cate_product)->with('brand_product',$brand_product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name'=>'required|min:5|max:255|unique:tbl_product',
            'product_price'=>'required|numeric|min:10000|max:10000000',
            'product_image'=>'required|required|mimes:jpeg,jpg,png,gif|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:10000',
            'product_content'=>'required|max:500',
        ];
        $messages = [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max ký tự",
            'product_name.min'=>" :attribute phải nhiều hơn :min ký tự ",
            'product_price.min'=>" :attribute nhiều hơn :min ",
            'product_price.max'=>" :attribute bé hơn :max ",
            'unique'=>":attribute đã tồn tại",
            'numeric'=>":attribute phải là số",
            'mimes'=>" :attribute không phù hợp",
        ];
        $attributes = [
            'product_name'=>"Tên sản phẩm",
            'product_price'=>"Giá sản phẩm",
            'product_image'=>"Hình ảnh sản phẩm",
            'product_content'=>"Nội dung sản phẩm"

        ];
        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
            $product = new Product();
            $product->product_name    = $request->product_name;
            $product->product_price    = $request->product_price;
            $product->product_content    = $request->product_content;
            $product->category_id    = $request->product_cate;
            $product->brand_id    = $request->product_brand;
            $product->product_status    = $request->product_status;
            $get_image = $request->file('product_image');
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/backend/product',$new_image);
                $product->product_image = $new_image;
                $product->save();
                Session::put('message','Thêm sản phẩm thành công');
                return redirect()->route('add-product');
            }
            return redirect()->route('add-product');
        }
        return back()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
