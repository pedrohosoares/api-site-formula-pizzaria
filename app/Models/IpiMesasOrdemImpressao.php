<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMesasOrdemImpressao
 * 
 * @property int $cod_mesas_ordem_impressao
 * @property int $cod_pizzarias
 * @property int $cod_impressoras
 * @property int $cod_usuarios_impressao
 * @property int $cod_colaboradores_impressao
 * @property \Carbon\Carbon $data_hora_impressao
 * @property string $tipo_impressao
 * @property string $software_impressao
 * @property string $situacao_ordem_impressao
 *
 * @package App\Models
 */
class IpiMesasOrdemImpressao extends Eloquent
{
	protected $table = 'ipi_mesas_ordem_impressao';
	protected $primaryKey = 'cod_mesas_ordem_impressao';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_impressoras' => 'int',
		'cod_usuarios_impressao' => 'int',
		'cod_colaboradores_impressao' => 'int'
	];

	protected $dates = [
		'data_hora_impressao'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_impressoras',
		'cod_usuarios_impressao',
		'cod_colaboradores_impressao',
		'data_hora_impressao',
		'tipo_impressao',
		'software_impressao',
		'situacao_ordem_impressao'
	];
}
