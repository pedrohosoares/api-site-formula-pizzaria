<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiInteresseComentario
 * 
 * @property int $cod_interesse_comentarios
 * @property int $cod_usuarios
 * @property int $cod_interesse_fraquia
 * @property string $comentario
 * @property \Carbon\Carbon $data_hora_comentario
 * 
 * @property \App\Models\IpiInteresseFraquium $ipi_interesse_fraquium
 * @property \App\Models\NucUsuario $nuc_usuario
 *
 * @package App\Models
 */
class IpiInteresseComentario extends Eloquent
{
	protected $primaryKey = 'cod_interesse_comentarios';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int',
		'cod_interesse_fraquia' => 'int'
	];

	protected $dates = [
		'data_hora_comentario'
	];

	protected $fillable = [
		'cod_usuarios',
		'cod_interesse_fraquia',
		'comentario',
		'data_hora_comentario'
	];

	public function ipi_interesse_fraquium()
	{
		return $this->belongsTo(\App\Models\IpiInteresseFraquium::class, 'cod_interesse_fraquia');
	}

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}
}
