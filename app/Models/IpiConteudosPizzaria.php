<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiConteudosPizzaria
 * 
 * @property int $cod_pizzarias
 * @property int $cod_bebidas_ipi_conteudos
 * @property int $cod_impressoras
 * @property float $preco
 * @property float $valor_imposto
 * @property int $pontos_fidelidade
 * @property bool $venda_net
 * @property int $quantidade_minima
 * @property int $quantidade_maxima
 * @property int $quantidade_perda
 * @property int $tempo_entrega
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiImpressora $ipi_impressora
 *
 * @package App\Models
 */
class IpiConteudosPizzaria extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_bebidas_ipi_conteudos' => 'int',
		'cod_impressoras' => 'int',
		'preco' => 'float',
		'valor_imposto' => 'float',
		'pontos_fidelidade' => 'int',
		'venda_net' => 'bool',
		'quantidade_minima' => 'int',
		'quantidade_maxima' => 'int',
		'quantidade_perda' => 'int',
		'tempo_entrega' => 'int'
	];

	protected $fillable = [
		'cod_impressoras',
		'preco',
		'valor_imposto',
		'pontos_fidelidade',
		'venda_net',
		'quantidade_minima',
		'quantidade_maxima',
		'quantidade_perda',
		'tempo_entrega',
		'situacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_impressora()
	{
		return $this->belongsTo(\App\Models\IpiImpressora::class, 'cod_impressoras');
	}
}
