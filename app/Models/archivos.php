<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;

class archivos extends Model
{
    use HasFactory, Hashidable, SoftDeletes;

    protected $appends = ['hashed_id'];

    protected $primaryKey = 'idar';

    protected $fillable = [
        'idar',
        'nombre',
        'ruta',
        'tipo',
        'idu',
        'activo'
    ];

    protected $atributes = [
        'activo' => 1
    ];
    protected $table = 'archivos';

    public function getHashedIdAttribute($value)
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
