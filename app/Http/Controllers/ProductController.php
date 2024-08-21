<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Resources\ProductResource;
use App\Services\External\MakeupApiService;
use App\Http\Requests\Product\{StoreProductRequest, UpdateProductRequest};

class ProductController extends Controller
{
    use PaginationTrait;
    public function __construct(protected MakeupApiService $productExternalService)
    {}

    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->name, function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            })
            ->when($request->brand, function ($query) use ($request) {
                $query->where('brand', 'LIKE', "%{$request->brand}%");
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('category', 'LIKE', "%{$request->category}%");
            })
            ->when($request->type, function ($query) use ($request) {
                $query->where('type', 'LIKE', "%{$request->type}%");
            })
            ->paginate();

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return ProductResource::make($product);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $product->update($request->validated());
        return ProductResource::make($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function getProductsByMakeupApi(Request $request)
    {
        $products = $this->productExternalService->getProducts();
        $products = $this->paginate($products, 3);
   
        return response()->json($products);
    }
}
