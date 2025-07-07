<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'packages_id',
        'redeem_code',
        'is_used',
        'used_date',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'is_used' => 'boolean',
        'used_date' => 'date',
        'created_at' => 'date',
        'updated_at' => 'date',
    ];

    public function game()
    {
        return $this->belongsTo(Product::class, 'game_id');
    }

    public function gamePackage()
    {
        return $this->belongsTo(ProductPackage::class, 'packages_id');
    }
}
