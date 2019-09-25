<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCaixasFisico
 * 
 * @property int $cod_caixas_fisicos
 * @property int $cod_pizzarias
 * @property string $numero_caixa
 * @property string $caixa_pedido_online
 * @property string $situacao_caixa_fisico
 *
 * @package App\Models
 */
class IpiCaixasFisico extends Eloquent
{
	protected $primaryKey = 'cod_caixas_fisicos';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'numero_caixa',
		'caixa_pedido_online',
		'situacao_caixa_fisico'
	];
}
