<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ItiTexto
 * 
 * @property int $cod_textos
 * @property int $cod_secoes
 * @property string $titulo
 * @property string $texto
 * @property \Carbon\Carbon $data_texto
 * @property \Carbon\Carbon $data_hora_texto
 * @property string $imagem_pna
 * @property string $imagem_gde
 * @property int $visualizacoes
 * @property string $orientacao_imagem
 * @property int $cliques
 * @property \Carbon\Carbon $data_inicio_exibicao
 * @property string $situacao
 * @property string $link
 * 
 * @property \App\Models\ItiSeco $iti_seco
 *
 * @package App\Models
 */
class ItiTexto extends Eloquent
{
	protected $primaryKey = 'cod_textos';
	public $timestamps = false;

	protected $casts = [
		'cod_secoes' => 'int',
		'visualizacoes' => 'int',
		'cliques' => 'int'
	];

	protected $dates = [
		'data_texto',
		'data_hora_texto',
		'data_inicio_exibicao'
	];

	protected $fillable = [
		'cod_secoes',
		'titulo',
		'texto',
		'data_texto',
		'data_hora_texto',
		'imagem_pna',
		'imagem_gde',
		'visualizacoes',
		'orientacao_imagem',
		'cliques',
		'data_inicio_exibicao',
		'situacao',
		'link'
	];

	public function iti_seco()
	{
		return $this->belongsTo(\App\Models\ItiSeco::class, 'cod_secoes');
	}
}
