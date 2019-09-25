<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCategoriasComentario
 * 
 * @property int $cod_categorias_comentarios
 * @property string $tipo_categoria
 * @property string $categoria_comentario
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_clientes_ipi_enquete_respostas_categorias_comentarios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_fale_conosco_categorias_comentarios
 *
 * @package App\Models
 */
class IpiCategoriasComentario extends Eloquent
{
	protected $primaryKey = 'cod_categorias_comentarios';
	public $timestamps = false;

	protected $fillable = [
		'tipo_categoria',
		'categoria_comentario'
	];

	public function ipi_clientes_ipi_enquete_respostas_categorias_comentarios()
	{
		return $this->hasMany(\App\Models\IpiClientesIpiEnqueteRespostasCategoriasComentario::class, 'cod_categorias_comentarios');
	}

	public function ipi_fale_conosco_categorias_comentarios()
	{
		return $this->hasMany(\App\Models\IpiFaleConoscoCategoriasComentario::class, 'cod_categorias_comentarios');
	}
}
