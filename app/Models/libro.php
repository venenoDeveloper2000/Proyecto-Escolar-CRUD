<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;
class libro extends Model
{
    use HasFactory, Hashidable, SoftDeletes;

    protected $appends = ['hashed_id'];

    protected $primaryKey = 'idl';

    protected $fillable = [
        'nombre',
        'idca',
        'activo'
    ];

    protected $attributes = [
        'activo' => 1
    ];

    protected $table = 'libros';

    public function getHashedIdAttribute($value)
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
