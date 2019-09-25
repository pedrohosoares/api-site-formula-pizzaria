<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoSubcategoriasSituaco
 * 
 * @property int $cod_ticket_subcategorias
 * @property int $cod_situacoes_origem
 * @property int $cod_situacoes_fim
 * 
 * @property \App\Models\IpiComunicacaoSubcategoria $ipi_comunicacao_subcategoria
 * @property \App\Models\IpiComunicacaoSituaco $ipi_comunicacao_situaco
 *
 * @package App\Models
 */
class IpiComunicacaoSubcategoriasSituaco extends Eloquent
{
	protected $table = 'ipi_comunicacao_subcategorias_situacoes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_ticket_subcategorias' => 'int',
		'cod_situacoes_origem' => 'int',
		'cod_situacoes_fim' => 'int'
	];

	public function ipi_comunicacao_subcategoria()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoSubcategoria::class, 'cod_ticket_subcategorias');
	}

	public function ipi_comunicacao_situaco()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoSituaco::class, 'cod_situacoes_fim');
	}
}
