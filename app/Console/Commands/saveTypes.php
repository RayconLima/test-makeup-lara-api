<?php

namespace App\Console\Commands;

use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class saveTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-types';

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
        $api = config('app.EXTERNAL_API').'/products.json';
        $productsData = json_decode(file_get_contents($api), true);
        
        $brands = [];
        foreach ($productsData as $product) {
            $brands[] = $product['product_type'];
        }

        $uniqueBrands = array_values(array_unique($brands));
        foreach ($uniqueBrands as $value) {
            if ($value != null) {
                $brand = new Type();
                $brand->name = $value;
                $brand->url = Str::slug($value);
                $brand->save();
            }
        }

        $this->info('Importing finished!');
    }
}
