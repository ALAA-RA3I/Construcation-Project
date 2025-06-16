<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
        protected $fillable = ['title','document','description','file_name','ipfs_cid'];

}
