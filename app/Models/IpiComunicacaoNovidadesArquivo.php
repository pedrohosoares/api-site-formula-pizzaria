<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoNovidadesArquivo
 * 
 * @property int $cod_novidades
 * @property string $nome_arquivo
 * @property string $descricao_arquivo
 * @property \Carbon\Carbon $data_hora_adicao
 * 
 * @property \App\Models\IpiComunicacaoNovidade $ipi_comunicacao_novidade
 *
 * @package App\Models
 */
class IpiComunicacaoNovidadesArquivo extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_novidades' => 'int'
	];

	protected $dates = [
		'data_hora_adicao'
	];

	protected $fillable = [
		'cod_novidades',
		'nome_arquivo',
		'descricao_arquivo',
		'data_hora_adicao'
	];

	public function ipi_comunicacao_novidade()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoNovidade::class, 'cod_novidades');
	}
}
