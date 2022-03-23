<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //Table Name
    protected $table = 'profiles';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true; 

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
