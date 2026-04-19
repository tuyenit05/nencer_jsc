<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //table name
    protected $table = 'categories';
    //table columns
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];

    public function receipts()
    {
        return $this->hasMany(Receipt::class, "category_id", "id");
    }
}
