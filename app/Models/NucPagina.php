<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NucPagina
 * 
 * @property int $cod_paginas
 * @property int $cod_paginas_pai
 * @property string $menu
 * @property string $arquivo
 * @property string $arquivo_aux1
 * @property string $arquivo_aux2
 * @property string $arquivo_aux3
 * @property int $ordem
 * @property bool $habilitado
 * @property bool $protegido
 * @property string $tipo
 * @property bool $permissoes
 *
 * @package App\Models
 */
class NucPagina extends Eloquent
{
	protected $primaryKey = 'cod_paginas';
	public $timestamps = false;

	protected $casts = [
		'cod_paginas_pai' => 'int',
		'ordem' => 'int',
		'habilitado' => 'bool',
		'protegido' => 'bool',
		'permissoes' => 'bool'
	];

	protected $fillable = [
		'cod_paginas_pai',
		'menu',
		'arquivo',
		'arquivo_aux1',
		'arquivo_aux2',
		'arquivo_aux3',
		'ordem',
		'habilitado',
		'protegido',
		'tipo',
		'permissoes'
	];
}
