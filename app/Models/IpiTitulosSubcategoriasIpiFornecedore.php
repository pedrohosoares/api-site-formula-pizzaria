<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTitulosSubcategoriasIpiFornecedore
 * 
 * @property int $cod_titulos_subcategorias
 * @property int $cod_fornecedores
 * 
 * @property \App\Models\IpiTitulosSubcategoria $ipi_titulos_subcategoria
 * @property \App\Models\IpiFornecedore $ipi_fornecedore
 *
 * @package App\Models
 */
class IpiTitulosSubcategoriasIpiFornecedore extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_titulos_subcategorias' => 'int',
		'cod_fornecedores' => 'int'
	];

	public function ipi_titulos_subcategoria()
	{
		return $this->belongsTo(\App\Models\IpiTitulosSubcategoria::class, 'cod_titulos_subcategorias');
	}

	public function ipi_fornecedore()
	{
		return $this->belongsTo(\App\Models\IpiFornecedore::class, 'cod_fornecedores');
	}
}
