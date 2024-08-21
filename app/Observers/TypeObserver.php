<?php

namespace App\Observers;

use App\Models\Type;
use Illuminate\Support\Str;

class TypeObserver
{
    /**
     * Handle the Brand "creating" event.
     */
    public function creating(Type $brand): void
    {
        $brand->url = Str::slug($brand->name);
    }

    /**
     * Handle the Brand "updating" event.
     */
    public function updating(Type $brand): void
    {
        $brand->url = Str::slug($brand->name);
    }
}
