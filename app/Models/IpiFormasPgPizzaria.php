<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFormasPgPizzaria
 * 
 * @property int $cod_formas_pg_pizzarias
 * @property int $cod_bancos
 * @property int $cod_titulos_subcategorias
 * @property int $cod_titulos_subcategorias_taxa
 * @property int $cod_pizzarias
 * @property int $cod_formas_pg
 * @property float $taxa
 * @property int $prazo
 * @property int $disponivel_ecommerce
 * 
 * @property \App\Models\IpiFormasPg $ipi_formas_pg
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiFormasPgPizzaria extends Eloquent
{
	protected $primaryKey = 'cod_formas_pg_pizzarias';
	public $timestamps = false;

	protected $casts = [
		'cod_bancos' => 'int',
		'cod_titulos_subcategorias' => 'int',
		'cod_titulos_subcategorias_taxa' => 'int',
		'cod_pizzarias' => 'int',
		'cod_formas_pg' => 'int',
		'taxa' => 'float',
		'prazo' => 'int',
		'disponivel_ecommerce' => 'int'
	];

	protected $fillable = [
		'cod_bancos',
		'cod_titulos_subcategorias',
		'cod_titulos_subcategorias_taxa',
		'cod_pizzarias',
		'cod_formas_pg',
		'taxa',
		'prazo',
		'disponivel_ecommerce'
	];

	public function ipi_formas_pg()
	{
		return $this->belongsTo(\App\Models\IpiFormasPg::class, 'cod_formas_pg');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
