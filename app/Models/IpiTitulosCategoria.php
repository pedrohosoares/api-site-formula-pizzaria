<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTitulosCategoria
 * 
 * @property int $cod_titulos_categorias
 * @property string $titulos_categoria
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_titulos_subcategorias
 *
 * @package App\Models
 */
class IpiTitulosCategoria extends Eloquent
{
	protected $primaryKey = 'cod_titulos_categorias';
	public $timestamps = false;

	protected $fillable = [
		'titulos_categoria'
	];

	public function ipi_titulos_subcategorias()
	{
		return $this->hasMany(\App\Models\IpiTitulosSubcategoria::class, 'cod_titulos_categorias');
	}
}
