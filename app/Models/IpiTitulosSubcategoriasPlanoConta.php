<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTitulosSubcategoriasPlanoConta
 * 
 * @property int $cod_titulos_subcategorias_plano_contas
 * @property int $cod_plano_contas
 * @property int $cod_titulos_subcategorias
 * 
 * @property \App\Models\IpiTitulosSubcategoria $ipi_titulos_subcategoria
 * @property \App\Models\IpiPlanoConta $ipi_plano_conta
 *
 * @package App\Models
 */
class IpiTitulosSubcategoriasPlanoConta extends Eloquent
{
	protected $primaryKey = 'cod_titulos_subcategorias_plano_contas';
	public $timestamps = false;

	protected $casts = [
		'cod_plano_contas' => 'int',
		'cod_titulos_subcategorias' => 'int'
	];

	protected $fillable = [
		'cod_plano_contas',
		'cod_titulos_subcategorias'
	];

	public function ipi_titulos_subcategoria()
	{
		return $this->belongsTo(\App\Models\IpiTitulosSubcategoria::class, 'cod_titulos_subcategorias');
	}

	public function ipi_plano_conta()
	{
		return $this->belongsTo(\App\Models\IpiPlanoConta::class, 'cod_plano_contas');
	}
}
