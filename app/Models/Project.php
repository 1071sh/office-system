<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $guarded = [''];
    public $incrementing = false; // increment無効化

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }
}
