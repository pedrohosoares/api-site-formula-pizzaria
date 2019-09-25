<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IcoCamposPagina
 * 
 * @property int $cod_campos_paginas
 * @property int $cod_tipos_campos
 * @property int $cod_paginas
 * @property string $conteudo
 * @property string $arquivo
 * @property bool $rascunho
 * @property int $numero
 * @property string $auxiliar
 * 
 * @property \App\Models\IcoTiposCampo $ico_tipos_campo
 * @property \App\Models\IcoPagina $ico_pagina
 *
 * @package App\Models
 */
class IcoCamposPagina extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_tipos_campos' => 'int',
		'cod_paginas' => 'int',
		'rascunho' => 'bool',
		'numero' => 'int'
	];

	protected $fillable = [
		'conteudo',
		'arquivo',
		'rascunho',
		'numero',
		'auxiliar'
	];

	public function ico_tipos_campo()
	{
		return $this->belongsTo(\App\Models\IcoTiposCampo::class, 'cod_tipos_campos');
	}

	public function ico_pagina()
	{
		return $this->belongsTo(\App\Models\IcoPagina::class, 'cod_paginas');
	}
}
