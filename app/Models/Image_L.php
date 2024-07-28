<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_L extends Model
{
    use HasFactory;

    /**
    * Summary of table
    * @var string
    */
   protected $table = 'image__l_s';
   public $timestamps = true;

   protected $dates = ['deleted_at'];
   protected $fillable = array(
    'imageId',
    'number'
   );
}
