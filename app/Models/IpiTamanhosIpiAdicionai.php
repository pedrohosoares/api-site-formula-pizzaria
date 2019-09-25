<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiAdicionai
 * 
 * @property int $cod_adicionais
 * @property int $cod_tamanhos
 * @property int $cod_pizzarias
 * @property float $preco
 * @property bool $selecao_padrao_adicional
 * @property float $valor_imposto
 * 
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiAdicionai $ipi_adicionai
 *
 * @package App\Models
 */
class IpiTamanhosIpiAdicionai extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_adicionais' => 'int',
		'cod_tamanhos' => 'int',
		'cod_pizzarias' => 'int',
		'preco' => 'float',
		'selecao_padrao_adicional' => 'bool',
		'valor_imposto' => 'float'
	];

	protected $fillable = [
		'preco',
		'selecao_padrao_adicional',
		'valor_imposto'
	];

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_adicionai()
	{
		return $this->belongsTo(\App\Models\IpiAdicionai::class, 'cod_adicionais');
	}
}
