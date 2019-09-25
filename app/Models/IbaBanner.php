<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:31 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IbaBanner
 * 
 * @property int $cod_banners
 * @property int $cod_tamanhos
 * @property string $imagem
 * @property string $link
 * @property string $descricao
 * @property int $cliques
 * @property int $visualizacoes
 * @property string $tipo
 * @property \Carbon\Carbon $data_exibicao_inicial
 * @property \Carbon\Carbon $data_exibicao_final
 * @property \Carbon\Carbon $hora_exibicao_inicial
 * @property \Carbon\Carbon $hora_exibicao_final
 * @property bool $exibicao_dom
 * @property bool $exibicao_seg
 * @property bool $exibicao_ter
 * @property bool $exibicao_qua
 * @property bool $exibicao_qui
 * @property bool $exibicao_sex
 * @property bool $exibicao_sab
 * 
 * @property \App\Models\IbaTamanho $iba_tamanho
 *
 * @package App\Models
 */
class IbaBanner extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_tamanhos' => 'int',
		'cliques' => 'int',
		'visualizacoes' => 'int',
		'exibicao_dom' => 'bool',
		'exibicao_seg' => 'bool',
		'exibicao_ter' => 'bool',
		'exibicao_qua' => 'bool',
		'exibicao_qui' => 'bool',
		'exibicao_sex' => 'bool',
		'exibicao_sab' => 'bool'
	];

	protected $dates = [
		'data_exibicao_inicial',
		'data_exibicao_final',
		'hora_exibicao_inicial',
		'hora_exibicao_final'
	];

	protected $fillable = [
		'imagem',
		'link',
		'descricao',
		'cliques',
		'visualizacoes',
		'tipo',
		'data_exibicao_inicial',
		'data_exibicao_final',
		'hora_exibicao_inicial',
		'hora_exibicao_final',
		'exibicao_dom',
		'exibicao_seg',
		'exibicao_ter',
		'exibicao_qua',
		'exibicao_qui',
		'exibicao_sex',
		'exibicao_sab'
	];

	public function iba_tamanho()
	{
		return $this->belongsTo(\App\Models\IbaTamanho::class, 'cod_tamanhos');
	}
}
