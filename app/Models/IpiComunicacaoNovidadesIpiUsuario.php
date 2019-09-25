<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoNovidadesIpiUsuario
 * 
 * @property int $cod_usuarios
 * @property int $cod_novidades
 * @property \Carbon\Carbon $data_hora_leitura
 * 
 * @property \App\Models\NucUsuario $nuc_usuario
 *
 * @package App\Models
 */
class IpiComunicacaoNovidadesIpiUsuario extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int',
		'cod_novidades' => 'int'
	];

	protected $dates = [
		'data_hora_leitura'
	];

	protected $fillable = [
		'cod_usuarios',
		'cod_novidades',
		'data_hora_leitura'
	];

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}
}
