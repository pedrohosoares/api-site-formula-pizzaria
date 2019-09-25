<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IcoTiposCampo
 * 
 * @property int $cod_tipos_campos
 * @property string $campo
 * @property string $tipo
 * @property string $descricao
 * @property bool $aceita_arquivo
 * @property int $ordem
 * @property bool $exibir
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ico_campos_modelos
 * @property \Illuminate\Database\Eloquent\Collection $ico_campos_paginas
 *
 * @package App\Models
 */
class IcoTiposCampo extends Eloquent
{
	protected $primaryKey = 'cod_tipos_campos';
	public $timestamps = false;

	protected $casts = [
		'aceita_arquivo' => 'bool',
		'ordem' => 'int',
		'exibir' => 'bool'
	];

	protected $fillable = [
		'campo',
		'tipo',
		'descricao',
		'aceita_arquivo',
		'ordem',
		'exibir'
	];

	public function ico_campos_modelos()
	{
		return $this->hasMany(\App\Models\IcoCamposModelo::class, 'cod_tipos_campos');
	}

	public function ico_campos_paginas()
	{
		return $this->hasMany(\App\Models\IcoCamposPagina::class, 'cod_tipos_campos');
	}
}
