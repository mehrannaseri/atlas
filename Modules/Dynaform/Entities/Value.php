<?php

namespace Modules\Dynaform\Entities;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = [];
    protected $table="dynaform_values";

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
