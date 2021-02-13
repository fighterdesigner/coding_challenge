<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\Http\Resources\ProductCollection;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        
        //Return the collection of products as a resource

        return ProductCollection::collection($products);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        
//        $product->id = $request->input('id');
//        $product->name = $request->input('name');
//        $product->description = $request->input('description');
//        $product->price = $request->input('price');
//        $product->categorie = $request->input('categorie');
//        $product->image_url = $request->input('image_url');
//        
//        $product->save();
        return new ProductCollection($product);
        
    }
    
public function upload(Request $request) {
    
        //************
        
        $filename = $request->file('image')->getClientOriginalName();
    
        $request->file('image')->move(public_path('images'),$filename);
            
}      
/****** update ********/

    public function udpdate(Request $request, $id)
    {
        
        $product = Product::find($id);
        
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->categorie = $request->input('categorie');
        $product->image_url = $request->input('image_url');
        
        $product->save(); 
        
        return new ProductCollection($product);
                
    }
/**************************/    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // Get a singe product
        
        $product = Product::find($id);
        
        
        return new ProductCollection($product);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }

}
