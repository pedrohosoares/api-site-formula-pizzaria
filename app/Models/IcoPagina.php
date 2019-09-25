<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IcoPagina
 * 
 * @property int $cod_paginas
 * @property int $cod_modelos
 * @property string $pagina
 * @property string $chamada
 * @property string $titulo
 * @property bool $home
 * @property bool $erro_404
 * @property bool $publicado
 * @property bool $habilitado
 * @property \Carbon\Carbon $data_hora_criacao
 * @property \Carbon\Carbon $data_hora_alteracao
 * @property \Carbon\Carbon $data_hora_publicacao
 * 
 * @property \App\Models\IcoModelo $ico_modelo
 * @property \Illuminate\Database\Eloquent\Collection $ico_campos_paginas
 * @property \Illuminate\Database\Eloquent\Collection $ico_menus
 *
 * @package App\Models
 */
class IcoPagina extends Eloquent
{
	protected $primaryKey = 'cod_paginas';
	public $timestamps = false;

	protected $casts = [
		'cod_modelos' => 'int',
		'home' => 'bool',
		'erro_404' => 'bool',
		'publicado' => 'bool',
		'habilitado' => 'bool'
	];

	protected $dates = [
		'data_hora_criacao',
		'data_hora_alteracao',
		'data_hora_publicacao'
	];

	protected $fillable = [
		'cod_modelos',
		'pagina',
		'chamada',
		'titulo',
		'home',
		'erro_404',
		'publicado',
		'habilitado',
		'data_hora_criacao',
		'data_hora_alteracao',
		'data_hora_publicacao'
	];

	public function ico_modelo()
	{
		return $this->belongsTo(\App\Models\IcoModelo::class, 'cod_modelos');
	}

	public function ico_campos_paginas()
	{
		return $this->hasMany(\App\Models\IcoCamposPagina::class, 'cod_paginas');
	}

	public function ico_menus()
	{
		return $this->hasMany(\App\Models\IcoMenu::class, 'cod_paginas');
	}
}
