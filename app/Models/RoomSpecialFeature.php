<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSpecialFeature extends Model
{
    protected $table = 'room_special_feature';
    protected $fillable = [
        'id',
        'room_id',
        'special_feature_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ]; 
    use HasFactory;
}
