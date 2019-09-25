<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiAdicionaisEstoque
 * 
 * @property int $cod_tamanhos
 * @property int $cod_adicionais
 * @property float $quantidade_estoque
 *
 * @package App\Models
 */
class IpiTamanhosIpiAdicionaisEstoque extends Eloquent
{
	protected $table = 'ipi_tamanhos_ipi_adicionais_estoque';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tamanhos' => 'int',
		'cod_adicionais' => 'int',
		'quantidade_estoque' => 'float'
	];

	protected $fillable = [
		'quantidade_estoque'
	];
}
