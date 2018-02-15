<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['name', 'start_time','end_time'];

    public function notes()
{
    return $this->hasMany('App\Note');
}
}
