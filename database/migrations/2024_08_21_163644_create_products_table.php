<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Brand::class)->nullable();
            $table->foreignIdFor(App\Models\Category::class)->nullable();
            $table->foreignIdFor(App\Models\Type::class)->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('price', 8, 2);
            $table->string('sku');
            $table->string('product_api_url');
            $table->integer('count_in_stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
