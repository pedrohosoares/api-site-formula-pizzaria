<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEmpresa
 * 
 * @property int $cod_empresas
 * @property string $nome_empresa
 *
 * @package App\Models
 */
class IpiEmpresa extends Eloquent
{
	protected $primaryKey = 'cod_empresas';
	public $timestamps = false;

	protected $fillable = [
		'nome_empresa'
	];
}
