<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:31 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IbaTamanho
 * 
 * @property int $cod_tamanhos
 * @property int $altura
 * @property int $largura
 * 
 * @property \Illuminate\Database\Eloquent\Collection $iba_banners
 *
 * @package App\Models
 */
class IbaTamanho extends Eloquent
{
	protected $primaryKey = 'cod_tamanhos';
	public $timestamps = false;

	protected $casts = [
		'altura' => 'int',
		'largura' => 'int'
	];

	protected $fillable = [
		'altura',
		'largura'
	];

	public function iba_banners()
	{
		return $this->hasMany(\App\Models\IbaBanner::class, 'cod_tamanhos');
	}
}
