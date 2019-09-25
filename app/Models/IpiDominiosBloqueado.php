<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiDominiosBloqueado
 * 
 * @property int $cod_dominios_bloqueados
 * @property string $dominio
 *
 * @package App\Models
 */
class IpiDominiosBloqueado extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_dominios_bloqueados' => 'int'
	];

	protected $fillable = [
		'cod_dominios_bloqueados',
		'dominio'
	];
}
