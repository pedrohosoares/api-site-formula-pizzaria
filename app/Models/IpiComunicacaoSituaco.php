<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoSituaco
 * 
 * @property int $cod_situacoes
 * @property string $nome_situacao
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_subcategorias_situacos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_tickets
 *
 * @package App\Models
 */
class IpiComunicacaoSituaco extends Eloquent
{
	protected $table = 'ipi_comunicacao_situacoes';
	protected $primaryKey = 'cod_situacoes';
	public $timestamps = false;

	protected $fillable = [
		'nome_situacao',
		'situacao'
	];

	public function ipi_comunicacao_subcategorias_situacos()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoSubcategoriasSituaco::class, 'cod_situacoes_fim');
	}

	public function ipi_comunicacao_tickets()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoTicket::class, 'cod_situacoes');
	}
}
