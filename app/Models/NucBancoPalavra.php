<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NucBancoPalavra
 * 
 * @property int $cod_banco_palavras
 * @property string $palavra
 * @property string $texto
 * @property bool $protegido
 *
 * @package App\Models
 */
class NucBancoPalavra extends Eloquent
{
	protected $primaryKey = 'cod_banco_palavras';
	public $timestamps = false;

	protected $casts = [
		'protegido' => 'bool'
	];

	protected $fillable = [
		'palavra',
		'texto',
		'protegido'
	];
}
