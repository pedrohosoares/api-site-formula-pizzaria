<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariasCupon
 * 
 * @property int $cod_pizzarias_cupons
 * @property int $cod_cupons
 * @property int $cod_pizzarias
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiCupon $ipi_cupon
 *
 * @package App\Models
 */
class IpiPizzariasCupon extends Eloquent
{
	protected $primaryKey = 'cod_pizzarias_cupons';
	public $timestamps = false;

	protected $casts = [
		'cod_cupons' => 'int',
		'cod_pizzarias' => 'int'
	];

	protected $fillable = [
		'cod_cupons',
		'cod_pizzarias'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_cupon()
	{
		return $this->belongsTo(\App\Models\IpiCupon::class, 'cod_cupons');
	}
}
