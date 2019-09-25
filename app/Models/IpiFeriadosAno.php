<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFeriadosAno
 * 
 * @property int $cod_feriados_ano
 * @property \Carbon\Carbon $ano
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_feriados_dias
 *
 * @package App\Models
 */
class IpiFeriadosAno extends Eloquent
{
	protected $table = 'ipi_feriados_ano';
	protected $primaryKey = 'cod_feriados_ano';
	public $timestamps = false;

	protected $dates = [
		'ano'
	];

	protected $fillable = [
		'ano'
	];

	public function ipi_feriados_dias()
	{
		return $this->hasMany(\App\Models\IpiFeriadosDia::class, 'cod_feriados_ano');
	}
}
