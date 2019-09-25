<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiSoftware
 * 
 * @property int $cod_softwares
 * @property string $software
 * @property string $arquivo
 * @property string $descricao
 * @property string $compatibilidade
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_software_permissos
 *
 * @package App\Models
 */
class IpiSoftware extends Eloquent
{
	protected $primaryKey = 'cod_softwares';
	public $timestamps = false;

	protected $fillable = [
		'software',
		'arquivo',
		'descricao',
		'compatibilidade',
		'situacao'
	];

	public function ipi_software_permissos()
	{
		return $this->hasMany(\App\Models\IpiSoftwarePermisso::class, 'cod_softwares');
	}
}
