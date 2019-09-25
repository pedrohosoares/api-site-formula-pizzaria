<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiClientesIpiEnqueteResposta
 * 
 * @property int $cod_clientes_ipi_enquete_respostas
 * @property int $cod_clientes
 * @property int $cod_enquete_respostas
 * @property string $justificativa
 * @property \Carbon\Carbon $data_hora_resposta
 * @property int $cod_pedidos
 * @property int $cod_usuarios
 * @property \Carbon\Carbon $data_hora_resposta_pizzaria
 * @property string $resposta_pizzaria
 * @property bool $respondida_pizzaria
 * @property bool $respondida_pizzaria_tel
 * 
 * @property \App\Models\IpiEnqueteResposta $ipi_enquete_resposta
 * @property \App\Models\IpiCliente $ipi_cliente
 * @property \Illuminate\Database\Eloquent\Collection $ipi_clientes_ipi_enquete_respostas_categorias_comentarios
 *
 * @package App\Models
 */
class IpiClientesIpiEnqueteResposta extends Eloquent
{
	protected $primaryKey = 'cod_clientes_ipi_enquete_respostas';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_enquete_respostas' => 'int',
		'cod_pedidos' => 'int',
		'cod_usuarios' => 'int',
		'respondida_pizzaria' => 'bool',
		'respondida_pizzaria_tel' => 'bool'
	];

	protected $dates = [
		'data_hora_resposta',
		'data_hora_resposta_pizzaria'
	];

	protected $fillable = [
		'cod_clientes',
		'cod_enquete_respostas',
		'justificativa',
		'data_hora_resposta',
		'cod_pedidos',
		'cod_usuarios',
		'data_hora_resposta_pizzaria',
		'resposta_pizzaria',
		'respondida_pizzaria',
		'respondida_pizzaria_tel'
	];

	public function ipi_enquete_resposta()
	{
		return $this->belongsTo(\App\Models\IpiEnqueteResposta::class, 'cod_enquete_respostas');
	}

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}

	public function ipi_clientes_ipi_enquete_respostas_categorias_comentarios()
	{
		return $this->hasMany(\App\Models\IpiClientesIpiEnqueteRespostasCategoriasComentario::class, 'cod_clientes_ipi_enquete_respostas');
	}
}
