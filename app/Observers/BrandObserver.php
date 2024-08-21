<?php

namespace App\Observers;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandObserver
{
    /**
     * Handle the Brand "creating" event.
     */
    public function creating(Brand $brand): void
    {
        $brand->url = Str::slug($brand->name);
    }

    /**
     * Handle the Brand "updating" event.
     */
    public function updating(Brand $brand): void
    {
        $brand->url = Str::slug($brand->name);
    }
}
