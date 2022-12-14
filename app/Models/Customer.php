<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'cep',
        'cidade',
        'cnpj',
        'logradouro',
        'bairro',
        'uf',
        'numero',
        'status',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','user_id', 'id');;
    }
}
