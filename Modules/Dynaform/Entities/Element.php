<?php

namespace Modules\Dynaform\Entities;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [];
    protected $table="dynaform_elements";

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function values()
    {
        return $this->hasMany(Value::class);

    }
}
