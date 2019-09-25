<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTitulosSubcategoria
 * 
 * @property int $cod_titulos_subcategorias
 * @property int $cod_titulos_categorias
 * @property string $titulos_subcategorias
 * @property string $tipo_cendente_sacado
 * @property int $num_parcelas_maximo
 * @property string $tipo_titulo
 * 
 * @property \App\Models\IpiTitulosCategoria $ipi_titulos_categoria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_titulos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_fornecedores
 * @property \Illuminate\Database\Eloquent\Collection $ipi_titulos_subcategorias_plano_contas
 *
 * @package App\Models
 */
class IpiTitulosSubcategoria extends Eloquent
{
	protected $primaryKey = 'cod_titulos_subcategorias';
	public $timestamps = false;

	protected $casts = [
		'cod_titulos_categorias' => 'int',
		'num_parcelas_maximo' => 'int'
	];

	protected $fillable = [
		'cod_titulos_categorias',
		'titulos_subcategorias',
		'tipo_cendente_sacado',
		'num_parcelas_maximo',
		'tipo_titulo'
	];

	public function ipi_titulos_categoria()
	{
		return $this->belongsTo(\App\Models\IpiTitulosCategoria::class, 'cod_titulos_categorias');
	}

	public function ipi_titulos()
	{
		return $this->hasMany(\App\Models\IpiTitulo::class, 'cod_titulos_subcategorias');
	}

	public function ipi_fornecedores()
	{
		return $this->belongsToMany(\App\Models\IpiFornecedore::class, 'ipi_titulos_subcategorias_ipi_fornecedores', 'cod_titulos_subcategorias', 'cod_fornecedores');
	}

	public function ipi_titulos_subcategorias_plano_contas()
	{
		return $this->hasMany(\App\Models\IpiTitulosSubcategoriasPlanoConta::class, 'cod_titulos_subcategorias');
	}
}
