<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMesasTaxa
 * 
 * @property int $cod_mesas_taxas
 * @property string $taxa
 * @property string $tipo_taxa
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_mesas_taxas_pizzarias
 *
 * @package App\Models
 */
class IpiMesasTaxa extends Eloquent
{
	protected $primaryKey = 'cod_mesas_taxas';
	public $timestamps = false;

	protected $fillable = [
		'taxa',
		'tipo_taxa',
		'situacao'
	];

	public function ipi_mesas_taxas_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiMesasTaxasPizzaria::class, 'cod_mesas_taxas');
	}
}
