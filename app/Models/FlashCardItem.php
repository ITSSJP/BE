<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashCardItem extends Model
{
    use HasFactory;
    protected $table = 'flash_card_items';
    protected $fillable = ['package_id', 'question', 'answer','created_at','updated_at'];
    public function package()
    {
        return $this->belongsTo(FlashCardPackage::class, 'package_id');
    }
}
