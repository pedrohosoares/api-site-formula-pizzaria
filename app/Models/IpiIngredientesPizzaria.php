<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngredientesPizzaria
 * 
 * @property int $cod_ingredientes_pizzarias
 * @property int $cod_pizzarias
 * @property int $cod_ingredientes
 * @property int $quantidade_minima
 * @property int $quantidade_maxima
 * @property int $quantidade_perda
 * @property int $tempo_entrega
 * 
 * @property \App\Models\IpiIngrediente $ipi_ingrediente
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiIngredientesPizzaria extends Eloquent
{
	protected $primaryKey = 'cod_ingredientes_pizzarias';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_ingredientes' => 'int',
		'quantidade_minima' => 'int',
		'quantidade_maxima' => 'int',
		'quantidade_perda' => 'int',
		'tempo_entrega' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_ingredientes',
		'quantidade_minima',
		'quantidade_maxima',
		'quantidade_perda',
		'tempo_entrega'
	];

	public function ipi_ingrediente()
	{
		return $this->belongsTo(\App\Models\IpiIngrediente::class, 'cod_ingredientes');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
