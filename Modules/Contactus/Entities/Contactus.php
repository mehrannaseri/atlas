<?php

namespace Modules\Contactus\Entities;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $fillable = ['fullname','email','message'];
    protected $table="contactus_messages";
}
