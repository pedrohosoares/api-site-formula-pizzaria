<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiVip
 * 
 * @property int $cod_vip
 * @property string $classificacao_vip
 * @property int $nivel_vip
 * @property string $cor_vip
 * @property string $situacao_vip
 *
 * @package App\Models
 */
class IpiVip extends Eloquent
{
	protected $table = 'ipi_vip';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_vip' => 'int',
		'nivel_vip' => 'int'
	];

	protected $fillable = [
		'cod_vip',
		'classificacao_vip',
		'nivel_vip',
		'cor_vip',
		'situacao_vip'
	];
}
