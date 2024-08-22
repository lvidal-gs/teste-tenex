<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelaCarne extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'valor',
        'data_vencimento',
        'entrada',
        'carne_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'carne_id'
    ];
}
