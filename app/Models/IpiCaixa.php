<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCaixa
 * 
 * @property int $cod_caixa
 * @property int $cod_usuarios_fechamento
 * @property int $cod_usuarios_abertura
 * @property int $cod_usuarios_atendentes
 * @property int $cod_pizzarias
 * @property int $cod_caixas_fisicos
 * @property \Carbon\Carbon $data_hora_abertura
 * @property \Carbon\Carbon $data_hora_fechamento
 * @property int $tempo_maximo_entrega
 * @property int $cod_motivos
 * @property string $erro_atendimento
 * @property string $erro_cozinha
 * @property string $erro_motoboy
 * @property string $erro_sistema
 * @property float $contagem_caixa
 * @property string $obs_caixa
 * @property string $obs_caixa_abertura
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\NucUsuario $nuc_usuario
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_caixa_ocorrencias
 *
 * @package App\Models
 */
class IpiCaixa extends Eloquent
{
	protected $table = 'ipi_caixa';
	protected $primaryKey = 'cod_caixa';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios_fechamento' => 'int',
		'cod_usuarios_abertura' => 'int',
		'cod_usuarios_atendentes' => 'int',
		'cod_pizzarias' => 'int',
		'cod_caixas_fisicos' => 'int',
		'tempo_maximo_entrega' => 'int',
		'cod_motivos' => 'int',
		'contagem_caixa' => 'float'
	];

	protected $dates = [
		'data_hora_abertura',
		'data_hora_fechamento'
	];

	protected $fillable = [
		'cod_usuarios_fechamento',
		'cod_usuarios_abertura',
		'cod_usuarios_atendentes',
		'cod_pizzarias',
		'cod_caixas_fisicos',
		'data_hora_abertura',
		'data_hora_fechamento',
		'tempo_maximo_entrega',
		'cod_motivos',
		'erro_atendimento',
		'erro_cozinha',
		'erro_motoboy',
		'erro_sistema',
		'contagem_caixa',
		'obs_caixa',
		'obs_caixa_abertura',
		'situacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios_fechamento');
	}

	public function ipi_pedidos()
	{
		return $this->belongsToMany(\App\Models\IpiPedido::class, 'ipi_caixa_ipi_pedidos', 'cod_caixa', 'cod_pedidos');
	}

	public function ipi_caixa_ocorrencias()
	{
		return $this->hasMany(\App\Models\IpiCaixaOcorrencia::class, 'cod_caixa');
	}
}
