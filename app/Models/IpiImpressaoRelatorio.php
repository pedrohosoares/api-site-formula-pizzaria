<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiImpressaoRelatorio
 * 
 * @property int $cod_impressao_relatorio
 * @property int $cod_entregadores
 * @property int $cod_usuarios
 * @property int $cod_pizzarias
 * @property int $cod_caixa
 * @property int $cod_pedidos
 * @property string $relatorio
 * @property \Carbon\Carbon $data_hora_inicial
 * @property \Carbon\Carbon $data_hora_final
 * @property float $valor_extra
 * @property \Carbon\Carbon $data_hora_impressao
 * @property string $situacao
 * @property string $json
 * 
 * @property \App\Models\NucUsuario $nuc_usuario
 *
 * @package App\Models
 */
class IpiImpressaoRelatorio extends Eloquent
{
	protected $table = 'ipi_impressao_relatorio';
	protected $primaryKey = 'cod_impressao_relatorio';
	public $timestamps = false;

	protected $casts = [
		'cod_entregadores' => 'int',
		'cod_usuarios' => 'int',
		'cod_pizzarias' => 'int',
		'cod_caixa' => 'int',
		'cod_pedidos' => 'int',
		'valor_extra' => 'float'
	];

	protected $dates = [
		'data_hora_inicial',
		'data_hora_final',
		'data_hora_impressao'
	];

	protected $fillable = [
		'cod_entregadores',
		'cod_usuarios',
		'cod_pizzarias',
		'cod_caixa',
		'cod_pedidos',
		'relatorio',
		'data_hora_inicial',
		'data_hora_final',
		'valor_extra',
		'data_hora_impressao',
		'situacao',
		'json'
	];

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}
}
