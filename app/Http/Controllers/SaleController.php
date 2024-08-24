<?php

namespace App\Http\Controllers;

use App\Models\{Sale, ItemSale, Product};
use Illuminate\Http\Request;
use App\Http\Resources\SaleResource;
use App\Http\Requests\Sale\{StoreSaleRequest, UpdateSaleRequest};

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::paginate();
        return SaleResource::collection($sales);
    }
    
    public function store(StoreSaleRequest $request)
    {
        $input  = $request->validated();
        
        $sale   = Sale::create($input);
        foreach($request->items as $item)
        {
            $product = Product::findOrFail($item['product_id']);
            
            if ($product->count_in_stock < 5) {
                response()->json(['msg' => 'Very low stock']);
                continue;
            }
            
            if ($product->count_in_stock == 0) {
                return response()->json(['error' => 'Insufficient stock'], 400);
            }

            // Reduce the count_in_stock
            $product->count_in_stock -= $item['quantity'];
            $product->save();

            ItemSale::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'unit_price' => $item['unit_price'],
                'quantity' => $item['quantity'],
            ]);
        }

        return SaleResource::make($sale);
    }

    public function update(Sale $sale, UpdateSaleRequest $request)
    {
        $input  = $request->validated();
        $sale->update($input);
        return SaleResource::make($sale);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
    }
}