<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;

class infodocentes extends Model
{
    use HasFactory, Hashidable, SoftDeletes;

    protected $appends = ['hashed_id'];

    protected $primaryKey = 'idindo';

    protected $fillable = [
        'idindo',
        'curp',
        'rfc',
        'edad',
        'telefono',
        'especialidad',
        'ingles',
        'gradoAcad',
        'anioslab',
        'aniosdoc',
        'fechaIng',
        'numCed',
        'calle',
        'colonia',
        'cp',
        'activo',
        'id_uadm'
    ];

    protected $attributes = [
        'activo' => 1
    ];

    protected $table = 'infodocentes';

    public function getHashedIdAttribute($value)
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
