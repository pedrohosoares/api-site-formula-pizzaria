<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMerchant
 * 
 * @property int $cod_merchants
 * @property int $cod_pizzarias
 * @property string $merchant
 * @property string $tipo
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiMerchant extends Eloquent
{
	protected $primaryKey = 'cod_merchants';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'merchant',
		'tipo'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
