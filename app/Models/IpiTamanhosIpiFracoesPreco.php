<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiFracoesPreco
 * 
 * @property int $cod_tamanhos
 * @property int $cod_fracoes_precos
 * @property float $preco
 * 
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiFracoesPreco $ipi_fracoes_preco
 *
 * @package App\Models
 */
class IpiTamanhosIpiFracoesPreco extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tamanhos' => 'int',
		'cod_fracoes_precos' => 'int',
		'preco' => 'float'
	];

	protected $fillable = [
		'preco'
	];

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_fracoes_preco()
	{
		return $this->belongsTo(\App\Models\IpiFracoesPreco::class, 'cod_fracoes_precos');
	}
}
