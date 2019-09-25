<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIfoodPolling
 * 
 * @property string $id
 * @property string $code
 * @property string $correlationid
 * @property string $createdat
 * @property int $cod_pedidos
 *
 * @package App\Models
 */
class IpiIfoodPolling extends Eloquent
{
	protected $table = 'ipi_ifood_polling';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int'
	];

	protected $fillable = [
		'code',
		'correlationid',
		'createdat',
		'cod_pedidos'
	];
}
