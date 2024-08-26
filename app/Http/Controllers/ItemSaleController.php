<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemSale\{StoreItemSaleRequest, UpdateItemSaleRequest};
use App\Models\ItemSale;
use App\Http\Resources\ItemSaleResource;

class ItemSaleController extends Controller
{
    public function index()
    {
        $itens = ItemSale::paginate();
        return ItemSaleResource::collection($itens);
    }
    public function store(StoreItemSaleRequest $request)
    {
        $input = $request->validated();
        $item = ItemSale::create($input);
        return ItemSaleResource::make($item);
    }

    public function update(ItemSale $itemSale, UpdateItemSaleRequest $request)
    {
        $itemSale->update($request->validated());
        return ItemSaleResource::make($itemSale);
    }

    public function destroy(ItemSale $itemSale)
    {
        $itemSale->delete();

        return response()->noContent();
    }
}
