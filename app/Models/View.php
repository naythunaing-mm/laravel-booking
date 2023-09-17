<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class View extends Model
{
    use HasFactory;
    protected $table = 'view';
    protected $fillable = [
        'id',
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ]; 
    public function getRoomByView() {
        return $this->hasMany(Room::class,'view_id','id');
    }
  
}
