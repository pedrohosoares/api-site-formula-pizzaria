<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiSoftwarePermisso
 * 
 * @property int $cod_software_permissoes
 * @property int $cod_pizzarias
 * @property int $cod_softwares
 * @property bool $todas_pizzarias
 * 
 * @property \App\Models\IpiSoftware $ipi_software
 *
 * @package App\Models
 */
class IpiSoftwarePermisso extends Eloquent
{
	protected $table = 'ipi_software_permissoes';
	protected $primaryKey = 'cod_software_permissoes';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_softwares' => 'int',
		'todas_pizzarias' => 'bool'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_softwares',
		'todas_pizzarias'
	];

	public function ipi_software()
	{
		return $this->belongsTo(\App\Models\IpiSoftware::class, 'cod_softwares');
	}
}
