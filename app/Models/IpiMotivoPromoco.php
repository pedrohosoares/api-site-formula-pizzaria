<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMotivoPromoco
 * 
 * @property int $cod_motivo_promocoes
 * @property string $motivo_promocao
 * @property string $situacao
 *
 * @package App\Models
 */
class IpiMotivoPromoco extends Eloquent
{
	protected $table = 'ipi_motivo_promocoes';
	protected $primaryKey = 'cod_motivo_promocoes';
	public $timestamps = false;

	protected $fillable = [
		'motivo_promocao',
		'situacao'
	];
}
