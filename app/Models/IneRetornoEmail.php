<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IneRetornoEmail
 * 
 * @property int $cod_motivo_retorno
 * @property string $tipo_motivo_retorno
 * @property string $nome_motivo_retorno
 *
 * @package App\Models
 */
class IneRetornoEmail extends Eloquent
{
	protected $table = 'ine_retorno_email';
	protected $primaryKey = 'cod_motivo_retorno';
	public $timestamps = false;

	protected $fillable = [
		'tipo_motivo_retorno',
		'nome_motivo_retorno'
	];
}
