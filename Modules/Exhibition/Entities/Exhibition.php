<?php

namespace Modules\Exhibition\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Post\Entities\Language;
use Spatie\Permission\Traits\HasRoles;

class Exhibition extends Model
{
    protected $guard_name = 'web';
    protected $fillable = ['title','lang_id','state_id' , 'city_id' , 'start_holding' , 'end_holding' , 'start_reg' , 'end_reg' , 'pavilio_num' , 'address' , 'cpm'];

    public function lang()
    {
        return $this->belongsTo(Language::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
