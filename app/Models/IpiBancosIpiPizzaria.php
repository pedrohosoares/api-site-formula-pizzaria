<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiBancosIpiPizzaria
 * 
 * @property int $cod_bancos_pizzarias
 * @property int $cod_pizzarias
 * @property int $cod_bancos
 * 
 * @property \App\Models\IpiBanco $ipi_banco
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiBancosIpiPizzaria extends Eloquent
{
	protected $primaryKey = 'cod_bancos_pizzarias';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_bancos' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_bancos'
	];

	public function ipi_banco()
	{
		return $this->belongsTo(\App\Models\IpiBanco::class, 'cod_bancos');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
