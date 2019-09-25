<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPromoco
 * 
 * @property int $cod_promocoes
 * @property string $promocao
 * @property string $descricao
 * @property int $exibir_online
 * @property string $tipo
 * @property string $situacao
 *
 * @package App\Models
 */
class IpiPromoco extends Eloquent
{
	protected $table = 'ipi_promocoes';
	protected $primaryKey = 'cod_promocoes';
	public $timestamps = false;

	protected $casts = [
		'exibir_online' => 'int'
	];

	protected $fillable = [
		'promocao',
		'descricao',
		'exibir_online',
		'tipo',
		'situacao'
	];
}
