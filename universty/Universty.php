<?php

namespace Universty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universty extends Model 
{

    protected $table = 'Universties';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function ForeignKey()
    {
        return $this->hasMany('Gread');
    }

    public function ForeignKey()
    {
        return $this->belongsTo('Universty');
    }

}