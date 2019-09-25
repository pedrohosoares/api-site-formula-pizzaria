<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFeriadosDia
 * 
 * @property int $cod_feriados_dias
 * @property int $cod_feriados_ano
 * @property \Carbon\Carbon $dia
 * 
 * @property \App\Models\IpiFeriadosAno $ipi_feriados_ano
 *
 * @package App\Models
 */
class IpiFeriadosDia extends Eloquent
{
	protected $primaryKey = 'cod_feriados_dias';
	public $timestamps = false;

	protected $casts = [
		'cod_feriados_ano' => 'int'
	];

	protected $dates = [
		'dia'
	];

	protected $fillable = [
		'cod_feriados_ano',
		'dia'
	];

	public function ipi_feriados_ano()
	{
		return $this->belongsTo(\App\Models\IpiFeriadosAno::class, 'cod_feriados_ano');
	}
}
