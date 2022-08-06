<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->paginate(5);
        return  view('home',compact('products'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:products',
                'price' => 'required'
            ],
            [
                'name.required' => 'Name is required',
                'price.required'    => 'Price is required',
                'name.unique'   => 'This product title already exists'
            ]
        );

       $product = new Product();
       $product->name = $request->name;
       $product->price = $request->price;
       $product->save();

       return response()->json(['status'=> 'success']);

    }



    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:products,name,'.$request->id,
                'price' => 'required'
            ],
            [
                'name.required' => 'Name is required',
                'price.required'    => 'Price is required',
                'name.unique'   => 'This product title already exists'
            ]
        );

        Product::where('id',$request->id)->update([
           'name'   => $request->name,
           'price'  => $request->price
        ]);

        return response()->json(['status'=> 'success']);
    }


    public function destroy(request $request)
    {
        Product::find($request->id)->delete();
        return response()->json(['status'=> 'success']);
    }

    public function pagination(){
        $products = Product::latest()->paginate(5);
        return  view('include/product_pagination',compact('products'))->render();
    }


    public function productSearch(Request $request){

        $products = Product::where('name','like', '%'.$request->search.'%')
            ->orWhere('price','like', '%'.$request->search.'%')->orderBy('id','DESC')->paginate(5);

        if($products->count() >= 1){
            return  view('include/product_pagination',compact('products'))->render();
        }else{
            return response()->json(['status' => 'not_fount']);
        }


    }

}
