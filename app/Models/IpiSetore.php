<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiSetore
 * 
 * @property int $cod_setor
 * @property string $nome_setor
 *
 * @package App\Models
 */
class IpiSetore extends Eloquent
{
	protected $primaryKey = 'cod_setor';
	public $timestamps = false;

	protected $fillable = [
		'nome_setor'
	];
}
