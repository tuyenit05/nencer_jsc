<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    const Instock = 1;

    const Outstock = 2;

    const STATUS_PROCESSING = 0;

    const STATUS_DONE = 1;
    

    use HasFactory;
    protected $table = 'receipts';

    protected $fillable = [
        "storage_id","category_id","total_price","quantity","note",
        "delivery_date","type","user_id","image","name","logistics_providers_id",
        "status"
    ];

    public function storage()
    {
        return $this->hasOne(Storage::class, "id", "storage_id");
    }

    public function category()
    {
        //co the su dung belonngTo()
        return $this->hasOne(Category::class, "id", "category_id");
    }
}
