<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JatahCuti extends Model
{
    protected $table = 'jatah_cuti';
    protected $guarded =[];
	public $timestamps = false;

	public function user(){
		return $this->belongsTo('App\Models\User');
	}
}
