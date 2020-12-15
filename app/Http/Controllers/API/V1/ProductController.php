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
    public function index(Request $request)
    {
        if ($request->has('query_string')) {
            $product = Product::where('product_name', 'LIKE', '%' . $request->query_string . '%')->paginate(10);
            return new ProductCollection($product);
        } else {
            return new ProductCollection(Product::paginate(15));
        }

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

        return response(['statusMessage' => 'Update successfully'], 200);
    }

    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return response(['statusMessage' => 'Delete successfully'], 200);
        } else {
            return response()->json('error');
        }

    }

    public function searchProduct(Request $request)
    {

        $query_string =  $request->query_string;
        $product = Product::where('product_name', 'LIKE', '%' . $query_string . '%')->paginate(10);
        return new ProductCollection($product);

    }
}
