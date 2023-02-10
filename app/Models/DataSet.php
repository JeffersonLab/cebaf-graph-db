<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSet extends Model
{
    //TODO create a zip file containing data items
    use HasFactory;
    public $fillable = ['config','comment'];

    public function data(){
        return $this->hasMany(Data::class);
    }

}
