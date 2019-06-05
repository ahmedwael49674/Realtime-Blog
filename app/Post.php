<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
  protected $fillable = [
      'title', 'content', 'published'
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function comments(){
      return $this->hasMany('App\Comment');
  }

  public function getUpdatedAtAttribute($value)
  {
      return Carbon::parse($value)->toformatteddatestring();
  }

}
