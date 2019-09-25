<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiConfiguraco
 * 
 * @property string $chave
 * @property string $valor
 *
 * @package App\Models
 */
class IpiConfiguraco extends Eloquent
{
	protected $table = 'ipi_configuracoes';
	protected $primaryKey = 'chave';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'valor'
	];
}
