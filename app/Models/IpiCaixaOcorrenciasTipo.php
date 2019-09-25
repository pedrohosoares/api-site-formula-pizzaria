<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCaixaOcorrenciasTipo
 * 
 * @property int $cod_caixa_ocorrencias_tipo
 * @property string $tipo_ocorrencia
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_caixa_ocorrencias
 *
 * @package App\Models
 */
class IpiCaixaOcorrenciasTipo extends Eloquent
{
	protected $table = 'ipi_caixa_ocorrencias_tipo';
	protected $primaryKey = 'cod_caixa_ocorrencias_tipo';
	public $timestamps = false;

	protected $fillable = [
		'tipo_ocorrencia',
		'situacao'
	];

	public function ipi_caixa_ocorrencias()
	{
		return $this->hasMany(\App\Models\IpiCaixaOcorrencia::class, 'cod_caixa_ocorrencias_tipo');
	}
}
