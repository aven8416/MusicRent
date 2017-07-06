<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
  
    protected $table = 'address';

    protected $fillable = ['fullname', 'address','birth','passport_n','identification_n','user_id','phone','city'];
    
}
