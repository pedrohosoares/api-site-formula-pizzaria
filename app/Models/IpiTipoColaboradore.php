<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTipoColaboradore
 * 
 * @property int $cod_tipo_colaboradores
 * @property string $tipo_colaboradores
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_colaboradores
 *
 * @package App\Models
 */
class IpiTipoColaboradore extends Eloquent
{
	protected $primaryKey = 'cod_tipo_colaboradores';
	public $timestamps = false;

	protected $fillable = [
		'tipo_colaboradores'
	];

	public function ipi_colaboradores()
	{
		return $this->hasMany(\App\Models\IpiColaboradore::class, 'cod_tipo_colaboradores');
	}
}
