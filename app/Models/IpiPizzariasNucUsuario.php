<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariasNucUsuario
 * 
 * @property int $cod_pizzarias
 * @property int $cod_usuarios
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\NucUsuario $nuc_usuario
 *
 * @package App\Models
 */
class IpiPizzariasNucUsuario extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_usuarios' => 'int'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}
}
