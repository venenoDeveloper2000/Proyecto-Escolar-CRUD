<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluaciones extends Model
{
    use HasFactory, Hashidable, SoftDeletes;

    protected $appends = ['hashed_id'];

    protected $primaryKey = 'idev';

    protected $fillable = [
        'idev',
        'idu',
        'idmat',
        'idce',
        'idg',
        'calificacion',
        'activo'
    ];

    protected $attributes = [
        'activo' => 1
    ];
    //<--
    protected $table = 'evaluaciones';

    public function getHashedIdAttribute($value)
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
