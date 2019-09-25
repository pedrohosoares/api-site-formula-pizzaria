<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IcoModelo
 * 
 * @property int $cod_modelos
 * @property string $modelo
 * @property string $chamada
 * @property string $codigo
 * @property bool $biblioteca
 * @property string $descricao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ico_campos_modelos
 * @property \Illuminate\Database\Eloquent\Collection $ico_paginas
 *
 * @package App\Models
 */
class IcoModelo extends Eloquent
{
	protected $primaryKey = 'cod_modelos';
	public $timestamps = false;

	protected $casts = [
		'biblioteca' => 'bool'
	];

	protected $fillable = [
		'modelo',
		'chamada',
		'codigo',
		'biblioteca',
		'descricao'
	];

	public function ico_campos_modelos()
	{
		return $this->hasMany(\App\Models\IcoCamposModelo::class, 'cod_modelos');
	}

	public function ico_paginas()
	{
		return $this->hasMany(\App\Models\IcoPagina::class, 'cod_modelos');
	}
}
