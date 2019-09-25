<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMesasTaxasPizzaria
 * 
 * @property int $cod_mesas_taxas
 * @property int $cod_pizzarias
 * @property float $valor
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiMesasTaxa $ipi_mesas_taxa
 *
 * @package App\Models
 */
class IpiMesasTaxasPizzaria extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_mesas_taxas' => 'int',
		'cod_pizzarias' => 'int',
		'valor' => 'float'
	];

	protected $fillable = [
		'valor'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_mesas_taxa()
	{
		return $this->belongsTo(\App\Models\IpiMesasTaxa::class, 'cod_mesas_taxas');
	}
}
