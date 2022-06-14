<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Api\ApiController;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  Product::latest('id')->get();

        return $this->sendResponse(
            $products,
            "All products.",
            200,
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($product instanceof Product && $request->has("image") && file_exists($request->image)) {
            $product->addMedia($request->image)->toMediaCollection('product-image');
        }

        return $this->sendResponse(
            $product,
            "Product has been created successfully.",
            201,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  Product::find($id);
        return $this->sendResponse(
            $product,
            "Single product.",
            200,
        );
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
    public function update(ProductRequest $request, $id)
    {
        $product =  Product::find($id);
        if ($product instanceof Product) {
            $product->update($request->validated());
        }

        if ($product instanceof Product && $request->has("image") && file_exists($request->image)) {
            $product->clearMediaCollection("product-image");
            $product->addMedia($request->image)->toMediaCollection('product-image');
        }

        return $this->sendResponse(
            $product->refresh(),
            "Product has been updated successfully.",
            201,
        );
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
        if ($product instanceof Product) {
            $product->clearMediaCollection("product-image");
            $product->delete();

            return $this->sendResponse(
                $product,
                "Product has been deleted successfully.",
                200,
            );
        }

        return $this->sendError(
            $product,
            "Something went Wrong.",
            404,
        );
    }
}
