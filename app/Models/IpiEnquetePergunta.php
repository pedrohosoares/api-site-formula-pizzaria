<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEnquetePergunta
 * 
 * @property int $cod_enquete_perguntas
 * @property int $cod_enquete_perguntas_pai
 * @property int $cod_enquetes
 * @property string $pergunta
 * @property int $ordem
 * @property bool $pergunta_pessoal
 * 
 * @property \App\Models\IpiEnquete $ipi_enquete
 * @property \Illuminate\Database\Eloquent\Collection $ipi_enquete_respostas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_enquete_respostas_permitidas
 *
 * @package App\Models
 */
class IpiEnquetePergunta extends Eloquent
{
	protected $primaryKey = 'cod_enquete_perguntas';
	public $timestamps = false;

	protected $casts = [
		'cod_enquete_perguntas_pai' => 'int',
		'cod_enquetes' => 'int',
		'ordem' => 'int',
		'pergunta_pessoal' => 'bool'
	];

	protected $fillable = [
		'cod_enquete_perguntas_pai',
		'cod_enquetes',
		'pergunta',
		'ordem',
		'pergunta_pessoal'
	];

	public function ipi_enquete()
	{
		return $this->belongsTo(\App\Models\IpiEnquete::class, 'cod_enquetes');
	}

	public function ipi_enquete_respostas()
	{
		return $this->hasMany(\App\Models\IpiEnqueteResposta::class, 'cod_enquete_perguntas');
	}

	public function ipi_enquete_respostas_permitidas()
	{
		return $this->hasMany(\App\Models\IpiEnqueteRespostasPermitida::class, 'cod_enquete_perguntas');
	}
}
