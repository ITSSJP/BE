<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashCardPackage extends Model
{
    use HasFactory;
    protected $table = 'flash_card_packages';
    protected $fillable = ['title','description','owner_id','room_id','created_at','updated_at'];

    public function owner(){
        return $this->belongsTo(User::class);
    }
    public function  room(){
        return $this->belongsTo(Room::class);
    }
    public function items()
    {
        return $this->hasMany(FlashCardItem::class, 'package_id');
    }
}
