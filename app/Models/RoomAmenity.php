<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAmenity extends Model
{
    use HasFactory;
    protected $table = 'room_amenity';
    protected $fillable = [
        'id',
        'room_id',
        'amenity_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ]; 
    public function getRoomAmenityByRoom() {
        return $this->hasMany(Room::class,'room_id','id');
    }

    
}
