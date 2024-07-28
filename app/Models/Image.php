<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

     /**
     * Summary of table
     * @var string
     */
    protected $table = 'images';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'path',
        'type',
        'userId'
    );
}
