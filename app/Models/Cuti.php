<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cuti';
    protected $guarded =[];
	public $timestamps = false;

    public function users(){
    	return $this->belongsTo('App\Models\User');
    }

}
