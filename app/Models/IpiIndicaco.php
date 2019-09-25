<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIndicaco
 * 
 * @property int $cod_indicacoes
 * @property string $nome
 * @property string $email
 * @property int $cod_clientes_indicador
 * @property \Carbon\Carbon $data_hora_indicacao
 *
 * @package App\Models
 */
class IpiIndicaco extends Eloquent
{
	protected $table = 'ipi_indicacoes';
	protected $primaryKey = 'cod_indicacoes';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes_indicador' => 'int'
	];

	protected $dates = [
		'data_hora_indicacao'
	];

	protected $fillable = [
		'nome',
		'email',
		'cod_clientes_indicador',
		'data_hora_indicacao'
	];
}
