<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation between levels and sections
    public function Halaqat()
    {
        return $this->belongsTo( Halaqa::class , 'halaqa_id' , 'id');
    }
}
