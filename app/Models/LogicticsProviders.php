<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class LogicticsProviders extends Model
{
    use HasFactory;
    protected $table = 'logistics_providers';
    protected $fillable = [
        "name", "cost"
    ];
}
