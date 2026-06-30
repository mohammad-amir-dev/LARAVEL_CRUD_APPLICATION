<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($validator->fails()){
            return redirect()->route('products.create')
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;

        if($request->hasFile('image')){
            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/products'),$imageName);

            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with('success','Product Created Successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit',compact('product'));
    }

    public function update(Request $request,$id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'sku' => 'required|unique:products,sku,'.$id,
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($validator->fails()){
            return redirect()->route('products.edit',$id)
                ->withErrors($validator)
                ->withInput();
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;

        if($request->hasFile('image')){

            if($product->image != null &&
                File::exists(public_path('uploads/products/'.$product->image))){

                File::delete(public_path('uploads/products/'.$product->image));
            }

            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/products'),$imageName);

            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with('success','Product Updated Successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->image != null &&
            File::exists(public_path('uploads/products/'.$product->image))){

            File::delete(public_path('uploads/products/'.$product->image));
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success','Product Deleted Successfully');
    }
}
