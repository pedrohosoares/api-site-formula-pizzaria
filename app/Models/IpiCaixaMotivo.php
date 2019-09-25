<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCaixaMotivo
 * 
 * @property int $cod_motivos
 * @property string $motivo
 * @property string $situacao
 *
 * @package App\Models
 */
class IpiCaixaMotivo extends Eloquent
{
	protected $primaryKey = 'cod_motivos';
	public $timestamps = false;

	protected $fillable = [
		'motivo',
		'situacao'
	];
}
