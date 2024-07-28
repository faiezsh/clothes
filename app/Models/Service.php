<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    /**
     * Summary of table
     * @var string
     */
    protected $table = 'services';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'userId',
        'ShopName',
        'numberService',
        'ServiceMachine'
    );
}
