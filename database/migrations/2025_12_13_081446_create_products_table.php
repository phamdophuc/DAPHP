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
        Schema::dropIfExists('products');

        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->decimal('price', 10, 2); 
            $table->decimal('promotion_price', 10, 2)->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('image_url')->nullable(); 
            $table->unsignedBigInteger('category_id'); 
            $table->boolean('status')->default(1); 
            $table->string('seo_title')->nullable(); 
            $table->integer('quantity'); 
            $table->boolean('is_hot')->default(0); 
            $table->timestamp('hot_start_date')->nullable(); 
            $table->timestamp('hot_end_date')->nullable(); 
            $table->unsignedBigInteger('brand_id')->nullable(); 
            $table->string('meta_keyword')->nullable(); 
            $table->unsignedBigInteger('created_by')->nullable(); 
            $table->timestamp('created_date')->useCurrent(); 
            $table->unsignedBigInteger('updated_by')->nullable(); 
            $table->timestamp('updated_date')->nullable()->useCurrentOnUpdate(); 

            // Khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
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
