<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoSubcategoria
 * 
 * @property int $cod_ticket_subcategorias
 * @property int $cod_categorias
 * @property string $nome_subcategoria
 * @property string $emails_associados
 * @property string $situacao
 * 
 * @property \App\Models\IpiComunicacaoCategoria $ipi_comunicacao_categoria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_subcategorias_situacos
 *
 * @package App\Models
 */
class IpiComunicacaoSubcategoria extends Eloquent
{
	protected $primaryKey = 'cod_ticket_subcategorias';
	public $timestamps = false;

	protected $casts = [
		'cod_categorias' => 'int'
	];

	protected $fillable = [
		'cod_categorias',
		'nome_subcategoria',
		'emails_associados',
		'situacao'
	];

	public function ipi_comunicacao_categoria()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoCategoria::class, 'cod_categorias');
	}

	public function ipi_comunicacao_subcategorias_situacos()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoSubcategoriasSituaco::class, 'cod_ticket_subcategorias');
	}
}
