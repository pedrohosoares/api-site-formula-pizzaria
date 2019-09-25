<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiOpcoesCorte
 * 
 * @property int $cod_opcoes_corte
 * @property int $cod_tamanhos
 * @property float $preco
 * @property bool $tamanho_padrao
 * @property bool $selecao_padrao_corte
 * 
 * @property \App\Models\IpiOpcoesCorte $ipi_opcoes_corte
 * @property \App\Models\IpiTamanho $ipi_tamanho
 *
 * @package App\Models
 */
class IpiTamanhosIpiOpcoesCorte extends Eloquent
{
	protected $table = 'ipi_tamanhos_ipi_opcoes_corte';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_opcoes_corte' => 'int',
		'cod_tamanhos' => 'int',
		'preco' => 'float',
		'tamanho_padrao' => 'bool',
		'selecao_padrao_corte' => 'bool'
	];

	protected $fillable = [
		'preco',
		'tamanho_padrao',
		'selecao_padrao_corte'
	];

	public function ipi_opcoes_corte()
	{
		return $this->belongsTo(\App\Models\IpiOpcoesCorte::class, 'cod_opcoes_corte');
	}

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}
}
