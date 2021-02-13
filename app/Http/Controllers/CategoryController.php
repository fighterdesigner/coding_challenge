<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('category_id', 0)->get();
                
        return CategoryCollection::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        
        return new CategoryCollection($category);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $subcategories = Category::where('category_id', $id)->get();
        
        if(count($subcategories) > 0){
            
        foreach($subcategories as $subcategory) {
            
            $subcategory->category_id = 0;
            $subcategory->save();
            
        }
            
        }
            
        $category->delete();
            
    }
    
    /******* Sub categories *********/
    
    public function fetchsubs($id) {
        
        
        if($id > 0) {
        
        $subcategories = Category::where('category_id', $id)->get();    
        return CategoryCollection::collection($subcategories);
            
        }else {
            return 1;
        }
    }
    /********************************/
    
    public function deletesubs($id) {
        
        $subcategories = Category::find($id);
        $subcategories->delete();
    }
    
/********** Fetch categories for products **************/

    public function fetchforproducts() {
        
        $forproducts = Category::all();
        
        if(count($forproducts) > 0){
            return CategoryCollection::collection($forproducts);
        }else {
            return 1;
        }
    }
    
    
}
