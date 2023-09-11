<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialFeature extends Model
{
    use HasFactory;
    protected $table = 'special_feature';
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
    
}
