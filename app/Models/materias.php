<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Hashidable;

class materias extends Model
{
  use HasFactory, SoftDeletes, Hashidable;

  protected $appends = ['hashed_id'];

  protected $primaryKey = "idmat";
  protected $fillable = [
      'idmat_carr',
      'idca',
      'idu',
      'idg',
      'idce',
      'idc',
      'activo'
    ];

    protected $table = 'materias';
    public function getHashedIdAttribute($value)

    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
