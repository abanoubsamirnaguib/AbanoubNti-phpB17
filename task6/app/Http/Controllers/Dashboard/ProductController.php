<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\services\Media;
use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public const STATUSES = ['Not Active', 'Active'];
    public const MAX_UPLOAD_SIZE = 1024; 
    public const AVAIALBE_EXTENSIONS = ['png', 'jpeg', 'jpg'];


    public function index(Request $request)
    {
        $products = DB::table('products')->select('id','name' ,'desc_'.App::currentLocale().' AS desc','price','quantity')->get(); 
        if($request->wantsJson()){
            return $this->data(compact('products'),__('message.all.products'));
        }
        return view('products.index', compact('products'));
    }

    public function create(Request $request)
    {
        $brands = DB::table('brands')->select('id', 'name_en', 'name_ar')->get();
        $subcategories = DB::table('sub_categories')->select('id', 'name_en', 'name_ar')->get();
        if($request->wantsJson()){
            return $this->data(compact('brands', 'subcategories'));
        }
        return view('products.create', compact('brands', 'subcategories'))->with('statues', self::STATUSES);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['image'] = Media::upload($request->file('image'),'products');
        DB::table('products')->insert($data);
        if($request->wantsJson()){
            return $this->successResponse("Product Created Successfully",201);
        }
        return $this->redirectAccordingToRequest($request,"Product Created Successfully");
    }

    public function edit(Request $request,$id)
    {
        $product = DB::table('products')->where('id', $id)->first() ?? (object)[];
        $brands = DB::table('brands')->select('id', 'name_en', 'name_ar')->get();
        $subcategories = DB::table('sub_categories')->select('id', 'name_en', 'name_ar')->get();
        if($request->wantsJson()){
            return $this->data(compact('product','brands', 'subcategories'));
        }
        return view('products.edit', compact('product','brands', 'subcategories'))->with('statues', self::STATUSES);
    }

    public function update(UpdateProductRequest $request,$id)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = Media::upload($request->file('image'),'products');
            $product = DB::table('products')->where('id', $id)->first();
            Media::delete($product->image,'products');
        }
        DB::table('products')->where('id',$id)->update($data);
        if($request->wantsJson()){
            return $this->successResponse("Product Updated Successfully");
        }
        return $this->redirectAccordingToRequest($request,"Product Updated Successfully");
    }

    public function destroy(Request $request,$id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        Media::delete($product->image,'products');
        DB::table('products')->where('id', $id)->delete();
        if($request->wantsJson()){
            return $this->successResponse("Product Deleted Successfully");
        }
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
