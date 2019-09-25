<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngredientesIpiFornecedore
 * 
 * @property int $cod_fornecedores
 * @property int $cod_ingredientes
 * @property int $cod_item_fornecedor
 * @property int $quantidade_embalagem
 * @property string $unidade_trib
 * @property int $cean_trib
 *
 * @package App\Models
 */
class IpiIngredientesIpiFornecedore extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_fornecedores' => 'int',
		'cod_ingredientes' => 'int',
		'cod_item_fornecedor' => 'int',
		'quantidade_embalagem' => 'int',
		'cean_trib' => 'int'
	];

	protected $fillable = [
		'cod_fornecedores',
		'cod_ingredientes',
		'cod_item_fornecedor',
		'quantidade_embalagem',
		'unidade_trib',
		'cean_trib'
	];
}
