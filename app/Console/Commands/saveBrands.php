<?php

namespace App\Console\Commands;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

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
        $api = config('app.EXTERNAL_API').'/products.json';
        $productsData = json_decode(file_get_contents($api), true);
        
        $brands = [];
        foreach ($productsData as $product) {
            $brands[] = $product['brand'];
        }

        $uniqueBrands = array_values(array_unique($brands));
        foreach ($uniqueBrands as $value) {
            if ($value != null) {
                $brand = new Brand();
                $brand->name = $value;
                $brand->url = Str::slug($value);
                $brand->save();
            }
        }

        $this->info('Importing finished!');
    }
}
