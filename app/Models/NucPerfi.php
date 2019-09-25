<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NucPerfi
 * 
 * @property int $cod_perfis
 * @property string $perfil
 * 
 * @property \Illuminate\Database\Eloquent\Collection $nuc_usuarios
 *
 * @package App\Models
 */
class NucPerfi extends Eloquent
{
	protected $primaryKey = 'cod_perfis';
	public $timestamps = false;

	protected $fillable = [
		'perfil'
	];

	public function nuc_usuarios()
	{
		return $this->hasMany(\App\Models\NucUsuario::class, 'cod_perfis');
	}
}
