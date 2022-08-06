<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halaqa extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation between levels and sections
    // public function Admins()
    // {
    //     return $this->belongsTo( Admin::class , 'admin_id' , 'id');
    // }
    public $timestamps = false;

    // public function setAdminIdAttribute($value){
    //     $this -> attributes['admin_id'] = json_encode($value);
    // }
    // public function getAdmin_idAttribute($value){
    //     return json_decode($value);
    // }
}
