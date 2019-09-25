<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCaixaOcorrencia
 * 
 * @property int $cod_caixa_ocorrencias
 * @property int $cod_caixa_ocorrencias_tipo
 * @property int $cod_usuarios_ocorrencia
 * @property int $cod_caixa
 * @property string $ocorrencia
 * @property string $atendente
 * @property \Carbon\Carbon $data_hora_ocorrencia
 * @property int $cod_pedidos
 * 
 * @property \App\Models\IpiCaixa $ipi_caixa
 * @property \App\Models\NucUsuario $nuc_usuario
 * @property \App\Models\IpiCaixaOcorrenciasTipo $ipi_caixa_ocorrencias_tipo
 *
 * @package App\Models
 */
class IpiCaixaOcorrencia extends Eloquent
{
	protected $primaryKey = 'cod_caixa_ocorrencias';
	public $timestamps = false;

	protected $casts = [
		'cod_caixa_ocorrencias_tipo' => 'int',
		'cod_usuarios_ocorrencia' => 'int',
		'cod_caixa' => 'int',
		'cod_pedidos' => 'int'
	];

	protected $dates = [
		'data_hora_ocorrencia'
	];

	protected $fillable = [
		'cod_caixa_ocorrencias_tipo',
		'cod_usuarios_ocorrencia',
		'cod_caixa',
		'ocorrencia',
		'atendente',
		'data_hora_ocorrencia',
		'cod_pedidos'
	];

	public function ipi_caixa()
	{
		return $this->belongsTo(\App\Models\IpiCaixa::class, 'cod_caixa');
	}

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios_ocorrencia');
	}

	public function ipi_caixa_ocorrencias_tipo()
	{
		return $this->belongsTo(\App\Models\IpiCaixaOcorrenciasTipo::class, 'cod_caixa_ocorrencias_tipo');
	}
}
