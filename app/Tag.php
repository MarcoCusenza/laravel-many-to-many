<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Tag extends Pivot
{
  public function posts()
  {
    return $this->belongsToMany("App\Post");
  }
}
