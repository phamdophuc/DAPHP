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
            $table->id(); // Cột ID
            $table->string('name'); // Tên sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->decimal('promotion_price', 10, 2)->nullable(); // Giá khuyến mãi
            $table->text('description')->nullable(); // Mô tả
            $table->string('image_url')->nullable(); // URL hình ảnh
            $table->unsignedBigInteger('category_id'); // ID danh mục
            $table->unsignedBigInteger('brand_id'); // ID thương hiệu
            $table->boolean('status')->default(1); // Trạng thái (1: Hoạt động, 0: Không hoạt động)
            $table->integer('quantity'); // Số lượng
            $table->timestamp('created_date')->useCurrent(); // Ngày tạo
            $table->timestamps();

            // Khóa ngoại (nếu cần thiết)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
