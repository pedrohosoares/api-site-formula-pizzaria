<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiFraco
 * 
 * @property int $cod_fracoes
 * @property int $cod_tamanhos
 * @property int $cod_pizzarias
 * @property float $preco
 * @property int $pontos_fidelidade
 * @property bool $selecao_padrao_fracao
 *
 * @package App\Models
 */
class IpiTamanhosIpiFraco extends Eloquent
{
	protected $table = 'ipi_tamanhos_ipi_fracoes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_fracoes' => 'int',
		'cod_tamanhos' => 'int',
		'cod_pizzarias' => 'int',
		'preco' => 'float',
		'pontos_fidelidade' => 'int',
		'selecao_padrao_fracao' => 'bool'
	];

	protected $fillable = [
		'cod_fracoes',
		'cod_tamanhos',
		'cod_pizzarias',
		'preco',
		'pontos_fidelidade',
		'selecao_padrao_fracao'
	];
}
