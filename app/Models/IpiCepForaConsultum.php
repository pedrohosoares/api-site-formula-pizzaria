<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCepForaConsultum
 * 
 * @property int $cod_cep_fora_consulta
 * @property int $cep
 * @property string $rua
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property \Carbon\Carbon $data_hora_consulta
 *
 * @package App\Models
 */
class IpiCepForaConsultum extends Eloquent
{
	protected $primaryKey = 'cod_cep_fora_consulta';
	public $timestamps = false;

	protected $casts = [
		'cep' => 'int'
	];

	protected $dates = [
		'data_hora_consulta'
	];

	protected $fillable = [
		'cep',
		'rua',
		'bairro',
		'cidade',
		'estado',
		'data_hora_consulta'
	];
}
