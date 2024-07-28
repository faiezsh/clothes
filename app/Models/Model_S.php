<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_S extends Model
{
    use HasFactory;
    /**
     * Summary of table
     * @var string
     */
    protected $table = 'model__s';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'userid',
        'idService',
        'path',
        'type'
    );

	/**
	 * Summary of table
	 * @return string
	 */
	public function getTable() {
		return $this->table;
	}

	/**
	 * Summary of table
	 * @param string $table Summary of table
	 * @return self
	 */
	public function setTable($table): self {
		$this->table = $table;
		return $this;
	}
}
