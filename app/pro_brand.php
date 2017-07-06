<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pro_brand extends Model
{
    protected $fillable = ['name'];
    protected $table = 'pro_brand';

    public function products() {
        return $this->belongsToMany('Product', 'pro_brand');
    }
}
