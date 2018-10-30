<?php

namespace Modules\Dynaform\Entities;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [];
    protected $table="dynaform";

    public function elements()
    {
        return $this->hasMany(Element::class)->orderBy('priority');
    }
}
