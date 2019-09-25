<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosCombo
 * 
 * @property int $cod_pedidos_combos
 * @property int $cod_combos
 * @property int $cod_pedidos
 * @property int $pontos_fidelidade
 * @property float $preco
 * @property bool $fidelidade
 * @property int $numero_combo
 *
 * @package App\Models
 */
class IpiPedidosCombo extends Eloquent
{
	protected $primaryKey = 'cod_pedidos_combos';
	public $timestamps = false;

	protected $casts = [
		'cod_combos' => 'int',
		'cod_pedidos' => 'int',
		'pontos_fidelidade' => 'int',
		'preco' => 'float',
		'fidelidade' => 'bool',
		'numero_combo' => 'int'
	];

	protected $fillable = [
		'cod_combos',
		'cod_pedidos',
		'pontos_fidelidade',
		'preco',
		'fidelidade',
		'numero_combo'
	];
}
