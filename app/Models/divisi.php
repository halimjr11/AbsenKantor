<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
    ];

    protected $table = 'divisis';
    protected $guarded =[];
    public $timestamps = false;
    
    public function user(){
    	return $this->hasMany('App\Models\User');
    }
}
