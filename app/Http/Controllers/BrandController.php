<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Resources\BrandResource;
use App\Http\Requests\Brand\{StoreBrandRequest, UpdateBrandRequest};

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate();
        
        return BrandResource::collection($brands);
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->validated());
        return BrandResource::make($brand);
    }

    public function update(Brand $brand, UpdateBrandRequest $request)
    {
        $brand->update($request->validated());
        return BrandResource::make($brand);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
    }
}
