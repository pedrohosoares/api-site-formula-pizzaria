<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiOndeConheceu
 * 
 * @property int $cod_onde_conheceu
 * @property string $onde_conheceu
 * @property string $situacao
 *
 * @package App\Models
 */
class IpiOndeConheceu extends Eloquent
{
	protected $table = 'ipi_onde_conheceu';
	protected $primaryKey = 'cod_onde_conheceu';
	public $timestamps = false;

	protected $fillable = [
		'onde_conheceu',
		'situacao'
	];
}
