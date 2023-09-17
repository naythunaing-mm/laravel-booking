<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Room extends Model
{
    use HasFactory;
    protected $table = 'room';
    protected $fillable = [
        'id',
        'name',
        'size',
        'occupancy',
        'bed_id',
        'view_id',
        'description',
        'detail',
        'price_per_day',
        'extra_bed_price',
        'thumbnail',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ]; 
    public function getRoomAmenityByRoom() {
        return $this->hasMany(RoomAmenity::class,'room_id','id');
    }
    public function getRoomSpecialFeaturByRoom() {
        return $this->hasMany(RoomSpecialFeature::class,'room_id','id');
    }
    public function getView():BelongsTo{
        return $this->belongsTo(View::class, 'view_id', 'id');
    }
    
}
