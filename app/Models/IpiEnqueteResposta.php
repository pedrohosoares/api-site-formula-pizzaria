<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEnqueteResposta
 * 
 * @property int $cod_enquete_respostas
 * @property int $cod_enquete_perguntas
 * @property string $resposta
 * @property bool $justifica
 * @property bool $justifica_opcional
 * 
 * @property \App\Models\IpiEnquetePergunta $ipi_enquete_pergunta
 * @property \Illuminate\Database\Eloquent\Collection $ipi_clientes
 * @property \Illuminate\Database\Eloquent\Collection $ipi_enquete_respostas_permitidas
 *
 * @package App\Models
 */
class IpiEnqueteResposta extends Eloquent
{
	protected $primaryKey = 'cod_enquete_respostas';
	public $timestamps = false;

	protected $casts = [
		'cod_enquete_perguntas' => 'int',
		'justifica' => 'bool',
		'justifica_opcional' => 'bool'
	];

	protected $fillable = [
		'cod_enquete_perguntas',
		'resposta',
		'justifica',
		'justifica_opcional'
	];

	public function ipi_enquete_pergunta()
	{
		return $this->belongsTo(\App\Models\IpiEnquetePergunta::class, 'cod_enquete_perguntas');
	}

	public function ipi_clientes()
	{
		return $this->belongsToMany(\App\Models\IpiCliente::class, 'ipi_clientes_ipi_enquete_respostas', 'cod_enquete_respostas', 'cod_clientes')
					->withPivot('cod_clientes_ipi_enquete_respostas', 'justificativa', 'data_hora_resposta', 'cod_pedidos', 'cod_usuarios', 'data_hora_resposta_pizzaria', 'resposta_pizzaria', 'respondida_pizzaria', 'respondida_pizzaria_tel');
	}

	public function ipi_enquete_respostas_permitidas()
	{
		return $this->hasMany(\App\Models\IpiEnqueteRespostasPermitida::class, 'cod_enquete_respostas');
	}
}
