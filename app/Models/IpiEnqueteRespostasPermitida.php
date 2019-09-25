<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEnqueteRespostasPermitida
 * 
 * @property int $cod_enquete_respostas_permitidas
 * @property int $cod_enquete_perguntas
 * @property int $cod_enquete_respostas
 * 
 * @property \App\Models\IpiEnquetePergunta $ipi_enquete_pergunta
 * @property \App\Models\IpiEnqueteResposta $ipi_enquete_resposta
 *
 * @package App\Models
 */
class IpiEnqueteRespostasPermitida extends Eloquent
{
	protected $primaryKey = 'cod_enquete_respostas_permitidas';
	public $timestamps = false;

	protected $casts = [
		'cod_enquete_perguntas' => 'int',
		'cod_enquete_respostas' => 'int'
	];

	protected $fillable = [
		'cod_enquete_perguntas',
		'cod_enquete_respostas'
	];

	public function ipi_enquete_pergunta()
	{
		return $this->belongsTo(\App\Models\IpiEnquetePergunta::class, 'cod_enquete_perguntas');
	}

	public function ipi_enquete_resposta()
	{
		return $this->belongsTo(\App\Models\IpiEnqueteResposta::class, 'cod_enquete_respostas');
	}
}
