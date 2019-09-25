<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ItiSeco
 * 
 * @property int $cod_secoes
 * @property string $secao
 * @property bool $exibir_data_hora
 * 
 * @property \Illuminate\Database\Eloquent\Collection $iti_textos
 *
 * @package App\Models
 */
class ItiSeco extends Eloquent
{
	protected $table = 'iti_secoes';
	protected $primaryKey = 'cod_secoes';
	public $timestamps = false;

	protected $casts = [
		'exibir_data_hora' => 'bool'
	];

	protected $fillable = [
		'secao',
		'exibir_data_hora'
	];

	public function iti_textos()
	{
		return $this->hasMany(\App\Models\ItiTexto::class, 'cod_secoes');
	}
}
