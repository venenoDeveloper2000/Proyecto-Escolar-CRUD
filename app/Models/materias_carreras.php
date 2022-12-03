<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Hashidable;

class materias_carreras extends Model
{
    use HasFactory, SoftDeletes, Hashidable;
    protected $appends = ['hashed_id'];

    protected $primaryKey = "idmat_carr";
    protected $fillable = [
      'nombre',
      'idca',
      'idc',
      'clave',
      'horas',
      'activo'
    ];

    protected $table = 'materias_carreras';
    protected $attributes = [
        'activo' => 1
    ];
    public function getHashedIdAttribute($value)

    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
