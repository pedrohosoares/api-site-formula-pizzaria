<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTimezone
 * 
 * @property string $nome_timezone
 * @property string $variacao_gmt
 * @property string $variacao_gmt2
 *
 * @package App\Models
 */
class IpiTimezone extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nome_timezone',
		'variacao_gmt',
		'variacao_gmt2'
	];
}
