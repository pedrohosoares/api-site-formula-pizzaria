<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngredientesIpiTipoMassa
 * 
 * @property int $cod_tipo_massa
 * @property int $cod_ingredientes
 * @property int $cod_tamanhos
 * @property float $quantidade_estoque_ingrediente
 *
 * @package App\Models
 */
class IpiIngredientesIpiTipoMassa extends Eloquent
{
	protected $table = 'ipi_ingredientes_ipi_tipo_massa';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tipo_massa' => 'int',
		'cod_ingredientes' => 'int',
		'cod_tamanhos' => 'int',
		'quantidade_estoque_ingrediente' => 'float'
	];

	protected $fillable = [
		'cod_tipo_massa',
		'cod_ingredientes',
		'cod_tamanhos',
		'quantidade_estoque_ingrediente'
	];
}
