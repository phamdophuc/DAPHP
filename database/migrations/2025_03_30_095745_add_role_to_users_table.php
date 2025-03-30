<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
{
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('role_id')->nullable()->after('id');
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
    });
    DB::table('roles')->insert([
        ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'user', 'created_at' => now(), 'updated_at' => now()],
    ]);
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['role_id']);
        $table->dropColumn('role_id');
    });
    Schema::dropIfExists('roles');
}
};
