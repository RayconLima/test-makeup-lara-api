<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Resources\ProductResource;
use App\Services\External\MakeupApiService;
use App\Http\Requests\Product\{StoreProductRequest, UpdateProductRequest};
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Type;

class ProductController extends Controller
{
    use PaginationTrait;
    public function __construct(protected MakeupApiService $productExternalService)
    {}

    public function index(Request $request)
    {
        $products = Product::query()
            ->with(['brand', 'category', 'type'])
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

    public function getProductsByMakeupApi()
    {
        $productExternalService = new MakeupApiService();
        $products = $productExternalService->getProducts();

        $this->saveBrandUnique($products);
        $this->saveCategoryUnique($products);
        $this->saveTypeUnique($products);
        $this->saveProducts($products);
        
        return response()->json($products);
    }

    private function saveBrandUnique($productsData)
    {
        $brands = [];
        foreach ($productsData as $product) {
            $brands[] = $product['brand'];
        }

        $uniqueBrands = array_values(array_unique($brands));
        foreach ($uniqueBrands as $value) {
            if ($value != null) {
                $brand          = new Brand();
                $brand->name    = $value;
                $brand->url     = Str::slug($value);
                $brand->save();
            }
        }

        return $uniqueBrands;
    }

    private function saveTypeUnique($productsData)
    {
        $types = [];
        foreach ($productsData as $product) {
            $types[] = $product['product_type'];
        }

        $uniqueBrands = array_values(array_unique($types));
        foreach ($uniqueBrands as $value) {
            if ($value != null) {
                $brand          = new Type();
                $brand->name    = $value;
                $brand->url     = Str::slug($value);
                $brand->save();
            }
        }
    }

    private function saveCategoryUnique($productsData)
    {
        $categories = [];
        foreach ($productsData as $product) {
            $categories[] = $product['category'];
        }

        $uniqueBrands = array_values(array_unique($categories));
        foreach ($uniqueBrands as $value) {
            if ($value != null) {
                $categories         = new Category();
                $categories->name   = $value;
                $categories->url    = Str::slug($value);
                $categories->save();
            }
        }

        return $uniqueBrands;
    }

    private function saveProducts($products)
    {
        foreach ($products as $item) {
            $brand      = Brand::where('name', $item->brand)->first();
            $category   = Category::where('name', $item->category)->first();
            $type       = Type::where('name', $item->product_type)->first();
            $product    = new Product();

            if($brand) {
                $product->brand_id      = $brand->id;
            }
            if($category) {
                $product->category_id   = $category->id;
            }
            if($type) {
                $product->type_id       = $type->id;
            }

            $product->name              = $item->name;
            $product->description       = $item->description;
            $product->price             = $item->price ?? 0;
            $product->count_in_stock    = 15;
            $product->product_api_url   = $item->product_api_url;
            $product->save();
        }
    }
}
