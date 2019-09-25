<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMensagemPizzaria
 * 
 * @property int $cod_mensagem_pizzarias
 * @property int $cod_usuarios
 * @property int $cod_pizzarias
 * @property string $mensagem_pizzaria
 * @property \Carbon\Carbon $data_hora_exibicao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\NucUsuario $nuc_usuario
 *
 * @package App\Models
 */
class IpiMensagemPizzaria extends Eloquent
{
	protected $primaryKey = 'cod_mensagem_pizzarias';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int',
		'cod_pizzarias' => 'int'
	];

	protected $dates = [
		'data_hora_exibicao'
	];

	protected $fillable = [
		'cod_usuarios',
		'cod_pizzarias',
		'mensagem_pizzaria',
		'data_hora_exibicao'
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
