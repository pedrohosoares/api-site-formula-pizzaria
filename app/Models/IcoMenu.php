<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IcoMenu
 * 
 * @property int $cod_menus
 * @property int $cod_paginas
 * @property int $cod_menus_pai
 * @property string $menu
 * @property string $tipo
 * @property int $ordem
 * @property bool $habilitado
 * 
 * @property \App\Models\IcoPagina $ico_pagina
 *
 * @package App\Models
 */
class IcoMenu extends Eloquent
{
	protected $primaryKey = 'cod_menus';
	public $timestamps = false;

	protected $casts = [
		'cod_paginas' => 'int',
		'cod_menus_pai' => 'int',
		'ordem' => 'int',
		'habilitado' => 'bool'
	];

	protected $fillable = [
		'cod_paginas',
		'cod_menus_pai',
		'menu',
		'tipo',
		'ordem',
		'habilitado'
	];

	public function ico_pagina()
	{
		return $this->belongsTo(\App\Models\IcoPagina::class, 'cod_paginas');
	}
}
