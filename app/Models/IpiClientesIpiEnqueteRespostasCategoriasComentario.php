<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiClientesIpiEnqueteRespostasCategoriasComentario
 * 
 * @property int $cod_clientes_ipi_enquete_respostas_categorias_comentarios
 * @property int $cod_categorias_comentarios
 * @property int $cod_clientes_ipi_enquete_respostas
 * 
 * @property \App\Models\IpiClientesIpiEnqueteResposta $ipi_clientes_ipi_enquete_resposta
 * @property \App\Models\IpiCategoriasComentario $ipi_categorias_comentario
 *
 * @package App\Models
 */
class IpiClientesIpiEnqueteRespostasCategoriasComentario extends Eloquent
{
	protected $primaryKey = 'cod_clientes_ipi_enquete_respostas_categorias_comentarios';
	public $timestamps = false;

	protected $casts = [
		'cod_categorias_comentarios' => 'int',
		'cod_clientes_ipi_enquete_respostas' => 'int'
	];

	protected $fillable = [
		'cod_categorias_comentarios',
		'cod_clientes_ipi_enquete_respostas'
	];

	public function ipi_clientes_ipi_enquete_resposta()
	{
		return $this->belongsTo(\App\Models\IpiClientesIpiEnqueteResposta::class, 'cod_clientes_ipi_enquete_respostas');
	}

	public function ipi_categorias_comentario()
	{
		return $this->belongsTo(\App\Models\IpiCategoriasComentario::class, 'cod_categorias_comentarios');
	}
}
