<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table ='rooms';
    protected $fillable = ['name', 'owner_id'];

    public function members()
    {
        return $this->belongsToMany(User::class, 'room_members', 'room_id', 'member_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
