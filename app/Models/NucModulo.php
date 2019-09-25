<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NucModulo
 * 
 * @property int $cod_modulos
 * @property string $modulo
 * @property \Carbon\Carbon $data_hora_instalacao
 *
 * @package App\Models
 */
class NucModulo extends Eloquent
{
	protected $primaryKey = 'cod_modulos';
	public $timestamps = false;

	protected $dates = [
		'data_hora_instalacao'
	];

	protected $fillable = [
		'modulo',
		'data_hora_instalacao'
	];
}
