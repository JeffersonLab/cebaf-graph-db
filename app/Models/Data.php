<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //TODO save graph and globals to correctly named files
    use HasFactory;

    public $timestamps = false;

    public $dates = ['timestamp'];

    public $fillable = ['timestamp','data_set_id','label','graph','globals'];

    protected $casts = [
        'globals' => 'array'
    ];


    public function dataSet(){
        return $this->belongsTo(DataSet::class);
    }
}
