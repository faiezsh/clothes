<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_service extends Model
{
    use HasFactory;

    /**
    * Summary of table
    * @var string
    */
   protected $table = 'image_services';
   public $timestamps = true;

   protected $dates = ['deleted_at'];
   protected $fillable = array(
    'imageId',
    'serviceId'
   );
}
