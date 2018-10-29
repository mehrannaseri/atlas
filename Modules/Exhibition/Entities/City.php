<?php

namespace Modules\Exhibition\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{
    protected $guard_name = 'web';
    protected $fillable = ['title' , 'state_id'];

    public function state()
    {
        return $this->belongsTo(City::class);
    }

    public function exhibitions()
    {
        return $this->hasMany(Exhibition::class);
    }
}
