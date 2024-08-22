<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Models\{Brand, Category, Type, Product};
use App\Services\External\MakeupApiService;

class saveBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-brands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->getProductsByMakeupApi();

        $this->info('Importing finished!');
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

    private function saveProducts($products)
    {
        foreach ($products as $item) {
            $product    = new Product();
            $type       = Type::where('name', $item->product_type)->first();
            $brand      = Brand::where('name', $item->brand)->first();
            $category   = Category::where('name', $item->category)->first();
            
            if($brand) {
                $product->brand_id = $brand->id;
            }
            if($category) {
                $product->category_id = $category->id;
            }

            if($type) {
                $product->type_id = $type->id;
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
