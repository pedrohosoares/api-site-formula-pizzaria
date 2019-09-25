<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFraco
 * 
 * @property int $cod_fracoes
 * @property int $fracoes
 *
 * @package App\Models
 */
class IpiFraco extends Eloquent
{
	protected $table = 'ipi_fracoes';
	protected $primaryKey = 'cod_fracoes';
	public $timestamps = false;

	protected $casts = [
		'fracoes' => 'int'
	];

	protected $fillable = [
		'fracoes'
	];
}
