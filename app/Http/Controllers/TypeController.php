<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Http\Resources\TypeResource;
use App\Http\Requests\Type\{StoreTypeRequest, UpdateTypeRequest};

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::paginate();
        return TypeResource::collection($types);
    }

    public function store(StoreTypeRequest $request)
    {
        $type = Type::create($request->validated());
        return TypeResource::make($type);
    }

    public function update(Type $type, UpdateTypeRequest $request)
    {
        $type->update($request->validated());
        return TypeResource::make($type);
    }

    public function destroy(Type $type)
    {
        $type->delete();
    }
}
