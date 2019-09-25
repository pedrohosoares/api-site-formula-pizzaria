<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPromocoesIpiPizzaria
 * 
 * @property int $cod_pizzarias
 * @property int $cod_promocoes
 * @property string $arquivo
 * @property string $situacao
 *
 * @package App\Models
 */
class IpiPromocoesIpiPizzaria extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_promocoes' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_promocoes',
		'arquivo',
		'situacao'
	];
}
