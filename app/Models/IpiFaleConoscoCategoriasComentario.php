<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFaleConoscoCategoriasComentario
 * 
 * @property int $cod_fale_conosco_categorias_comentarios
 * @property int $cod_categorias_comentarios
 * @property int $cod_fale_conosco
 * 
 * @property \App\Models\IpiFaleConosco $ipi_fale_conosco
 * @property \App\Models\IpiCategoriasComentario $ipi_categorias_comentario
 *
 * @package App\Models
 */
class IpiFaleConoscoCategoriasComentario extends Eloquent
{
	protected $primaryKey = 'cod_fale_conosco_categorias_comentarios';
	public $timestamps = false;

	protected $casts = [
		'cod_categorias_comentarios' => 'int',
		'cod_fale_conosco' => 'int'
	];

	protected $fillable = [
		'cod_categorias_comentarios',
		'cod_fale_conosco'
	];

	public function ipi_fale_conosco()
	{
		return $this->belongsTo(\App\Models\IpiFaleConosco::class, 'cod_fale_conosco');
	}

	public function ipi_categorias_comentario()
	{
		return $this->belongsTo(\App\Models\IpiCategoriasComentario::class, 'cod_categorias_comentarios');
	}
}
