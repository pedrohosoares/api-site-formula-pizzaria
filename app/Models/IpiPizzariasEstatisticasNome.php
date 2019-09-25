<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariasEstatisticasNome
 * 
 * @property int $cod_estatisticas
 * @property string $nome_estatistica
 * @property string $unidade
 * @property int $ordem_exibicao
 *
 * @package App\Models
 */
class IpiPizzariasEstatisticasNome extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_estatisticas' => 'int',
		'ordem_exibicao' => 'int'
	];

	protected $fillable = [
		'cod_estatisticas',
		'nome_estatistica',
		'unidade',
		'ordem_exibicao'
	];
}
