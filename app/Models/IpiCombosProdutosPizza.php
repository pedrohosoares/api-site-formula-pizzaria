<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCombosProdutosPizza
 * 
 * @property int $cod_combos_produtos_pizzas
 * @property int $cod_combos_produtos
 * @property int $cod_pizzas
 * @property string $selecionar_produto
 *
 * @package App\Models
 */
class IpiCombosProdutosPizza extends Eloquent
{
	protected $primaryKey = 'cod_combos_produtos_pizzas';
	public $timestamps = false;

	protected $casts = [
		'cod_combos_produtos' => 'int',
		'cod_pizzas' => 'int'
	];

	protected $fillable = [
		'cod_combos_produtos',
		'cod_pizzas',
		'selecionar_produto'
	];
}
