<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomMember extends Model
{
    use HasFactory;
    protected $table = 'room_members';
    protected $fillable = ['room_id', 'member_id'];

    public function room(){
        return $this->belongsTo(Room::class,'room_id');
    }
    public function members()
    {
        return $this->belongsToMany(User::class, 'room_members', 'room_id', 'member_id');
    }
}
