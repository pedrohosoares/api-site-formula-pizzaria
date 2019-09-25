<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoCronograma
 * 
 * @property int $cod_cronogramas
 * @property int $cod_usuarios
 * @property string $titulo_cronograma
 * @property string $mensagem_cronograma
 * @property \Carbon\Carbon $data_prevista
 * @property \Carbon\Carbon $data_hora_criado
 * @property string $status
 * 
 * @property \App\Models\NucUsuario $nuc_usuario
 *
 * @package App\Models
 */
class IpiComunicacaoCronograma extends Eloquent
{
	protected $primaryKey = 'cod_cronogramas';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int'
	];

	protected $dates = [
		'data_prevista',
		'data_hora_criado'
	];

	protected $fillable = [
		'cod_usuarios',
		'titulo_cronograma',
		'mensagem_cronograma',
		'data_prevista',
		'data_hora_criado',
		'status'
	];

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}
}
