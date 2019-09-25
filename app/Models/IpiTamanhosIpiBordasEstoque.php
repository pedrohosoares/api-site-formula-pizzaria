<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiBordasEstoque
 * 
 * @property int $cod_tamanhos
 * @property int $cod_bordas
 * @property float $quantidade_estoque
 *
 * @package App\Models
 */
class IpiTamanhosIpiBordasEstoque extends Eloquent
{
	protected $table = 'ipi_tamanhos_ipi_bordas_estoque';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tamanhos' => 'int',
		'cod_bordas' => 'int',
		'quantidade_estoque' => 'float'
	];

	protected $fillable = [
		'quantidade_estoque'
	];
}
