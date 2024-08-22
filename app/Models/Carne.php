<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carne extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_total',
        'valor_entrada',
        'data_primeiro_vencimento',
        'qtd_parcelas',
        'periodicidade',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'periodicidade'
    ];
}
