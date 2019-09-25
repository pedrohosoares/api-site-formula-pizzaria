<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTipoBebida
 * 
 * @property int $cod_tipo_bebida
 * @property string $tipo_bebida
 * @property string $situacao
 *
 * @package App\Models
 */
class IpiTipoBebida extends Eloquent
{
	protected $table = 'ipi_tipo_bebida';
	protected $primaryKey = 'cod_tipo_bebida';
	public $timestamps = false;

	protected $fillable = [
		'tipo_bebida',
		'situacao'
	];
}
