<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTipoPizza
 * 
 * @property int $cod_tipo_pizza
 * @property string $tipo_pizza
 * @property string $situacao
 *
 * @package App\Models
 */
class IpiTipoPizza extends Eloquent
{
	protected $table = 'ipi_tipo_pizza';
	protected $primaryKey = 'cod_tipo_pizza';
	public $timestamps = false;

	protected $fillable = [
		'tipo_pizza',
		'situacao'
	];
}
