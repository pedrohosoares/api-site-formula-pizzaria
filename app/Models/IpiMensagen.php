<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMensagen
 * 
 * @property int $id
 * @property string $texto
 * @property int $status
 * @property \Carbon\Carbon $criado
 * @property string $visualizados
 *
 * @package App\Models
 */
class IpiMensagen extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $dates = [
		'criado'
	];

	protected $fillable = [
		'texto',
		'status',
		'criado',
		'visualizados'
	];
}
