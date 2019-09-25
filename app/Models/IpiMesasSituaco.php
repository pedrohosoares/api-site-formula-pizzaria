<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMesasSituaco
 * 
 * @property int $cod_mesas_situacoes
 * @property string $situacao
 * @property string $imagem_mesa
 * @property string $cor_situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_mesas
 *
 * @package App\Models
 */
class IpiMesasSituaco extends Eloquent
{
	protected $table = 'ipi_mesas_situacoes';
	protected $primaryKey = 'cod_mesas_situacoes';
	public $timestamps = false;

	protected $fillable = [
		'situacao',
		'imagem_mesa',
		'cor_situacao'
	];

	public function ipi_mesas()
	{
		return $this->hasMany(\App\Models\IpiMesa::class, 'cod_mesas_situacoes');
	}
}
