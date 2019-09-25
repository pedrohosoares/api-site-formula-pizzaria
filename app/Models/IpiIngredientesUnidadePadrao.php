<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngredientesUnidadePadrao
 * 
 * @property int $cod_ingredientes_unidade_padrao
 * @property string $unidade_padrao
 *
 * @package App\Models
 */
class IpiIngredientesUnidadePadrao extends Eloquent
{
	protected $table = 'ipi_ingredientes_unidade_padrao';
	protected $primaryKey = 'cod_ingredientes_unidade_padrao';
	public $timestamps = false;

	protected $fillable = [
		'unidade_padrao'
	];
}
