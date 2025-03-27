<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID chính
            $table->unsignedBigInteger('user_id'); // Liên kết với bảng users
            $table->date('order_date'); // Ngày đặt hàng
            $table->decimal('total_price', 10, 2); // Tổng giá trị đơn hàng
            $table->string('ship_address')->nullable(); // Địa chỉ giao hàng
            $table->text('notes')->nullable(); // Ghi chú
            $table->enum('status', ['pending', 'completed', 'canceled']); // Trạng thái đơn hàng
            $table->timestamps(); // created_at và updated_at

            // Thiết lập khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
