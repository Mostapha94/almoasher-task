<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','name','category_id','description','rating','views','levels','hours','active'];
    protected $table = 'courses';

    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id');
    }
}
