<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Danh sách các vai trò mặc định
    public const ADMIN = 'admin';
    public const USER = 'user';

    /**
     * Kiểm tra xem vai trò có phải là Admin không
     */
    public function isAdmin()
    {
        return $this->name === self::ADMIN;
    }

    /**
     * Kiểm tra xem vai trò có phải là User không
     */
    public function isUser()
    {
        return $this->name === self::USER;
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }
}