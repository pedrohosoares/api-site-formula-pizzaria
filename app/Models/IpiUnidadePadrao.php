<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiUnidadePadrao
 * 
 * @property int $cod_unidade_padrao
 * @property string $unidade
 * @property string $abreviatura
 * @property int $divisor_comum
 *
 * @package App\Models
 */
class IpiUnidadePadrao extends Eloquent
{
	protected $table = 'ipi_unidade_padrao';
	protected $primaryKey = 'cod_unidade_padrao';
	public $timestamps = false;

	protected $casts = [
		'divisor_comum' => 'int'
	];

	protected $fillable = [
		'unidade',
		'abreviatura',
		'divisor_comum'
	];
}
