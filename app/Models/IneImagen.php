<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IneImagen
 * 
 * @property int $cod_imagens
 * @property int $cod_mensagens
 * @property string $tipo
 * @property string $arquivo
 * @property string $titulo
 *
 * @package App\Models
 */
class IneImagen extends Eloquent
{
	protected $primaryKey = 'cod_imagens';
	public $timestamps = false;

	protected $casts = [
		'cod_mensagens' => 'int'
	];

	protected $fillable = [
		'cod_mensagens',
		'tipo',
		'arquivo',
		'titulo'
	];
}
