<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomGallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'room_gallery';
    protected $fillable = [
        'id',
        'image',
        'room_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ]; 
    
    
}
