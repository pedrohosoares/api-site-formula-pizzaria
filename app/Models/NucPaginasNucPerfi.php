<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NucPaginasNucPerfi
 * 
 * @property int $cod_perfis
 * @property int $cod_paginas
 * @property bool $inserir
 * @property bool $apagar
 * @property bool $editar
 *
 * @package App\Models
 */
class NucPaginasNucPerfi extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_perfis' => 'int',
		'cod_paginas' => 'int',
		'inserir' => 'bool',
		'apagar' => 'bool',
		'editar' => 'bool'
	];

	protected $fillable = [
		'inserir',
		'apagar',
		'editar'
	];
}
