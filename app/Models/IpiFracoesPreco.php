<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFracoesPreco
 * 
 * @property int $cod_fracoes_precos
 * @property int $fracao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos
 *
 * @package App\Models
 */
class IpiFracoesPreco extends Eloquent
{
	protected $primaryKey = 'cod_fracoes_precos';
	public $timestamps = false;

	protected $casts = [
		'fracao' => 'int'
	];

	protected $fillable = [
		'fracao'
	];

	public function ipi_tamanhos()
	{
		return $this->belongsToMany(\App\Models\IpiTamanho::class, 'ipi_tamanhos_ipi_fracoes_precos', 'cod_fracoes_precos', 'cod_tamanhos')
					->withPivot('preco');
	}
}
