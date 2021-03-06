<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projecttype extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','status', 'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function courses()
	{
	    return $this->belongsToMany('App\Course');
	}

    public function project()
    {
        return $this->hasOne('App\Project');
    }
}
