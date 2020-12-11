<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\Product as ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollection(Product::paginate(20));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        Product::create($request->all());

        return response(['statusMessage' => 'save successfully'], 200);

    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        $product->update($request->all());

        return response(['status_message' => 'Update successfully'], 200);
    }

    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return response(['status_message' => 'Delete successfully'], 200);
        } else {
            return response()->json('error');
        }

    }
}
