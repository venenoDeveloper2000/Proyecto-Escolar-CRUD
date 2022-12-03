<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;

class usuarios extends Model
{
    use HasFactory, Hashidable, SoftDeletes;

    protected $appends = ['hashed_id'];

    protected $primaryKey = 'idu';

    protected $fillable = [
        'idu',
        'matricula',
        'foto',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'activo',
        'sexo',
        'idg',
        'deleted_at',
        'created_at',
        'updated_at'
    ];


    protected $table = 'usuarios';

    public function getHashedIdAttribute($value)
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
