<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiBorda
 * 
 * @property int $cod_bordas
 * @property int $cod_tamanhos
 * @property int $cod_pizzarias
 * @property float $preco
 * @property float $valor_imposto
 * @property int $pontos_fidelidade
 * @property bool $selecao_padrao_borda
 * 
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiBorda $ipi_borda
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_combos_produtos_bordas
 *
 * @package App\Models
 */
class IpiTamanhosIpiBorda extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_bordas' => 'int',
		'cod_tamanhos' => 'int',
		'cod_pizzarias' => 'int',
		'preco' => 'float',
		'valor_imposto' => 'float',
		'pontos_fidelidade' => 'int',
		'selecao_padrao_borda' => 'bool'
	];

	protected $fillable = [
		'preco',
		'valor_imposto',
		'pontos_fidelidade',
		'selecao_padrao_borda'
	];

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_borda()
	{
		return $this->belongsTo(\App\Models\IpiBorda::class, 'cod_bordas');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_combos_produtos_bordas()
	{
		return $this->hasMany(\App\Models\IpiCombosProdutosBorda::class, 'cod_bordas');
	}
}
