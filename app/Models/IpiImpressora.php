<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiImpressora
 * 
 * @property int $cod_impressoras
 * @property int $cod_pizzarias
 * @property string $nome_impressora
 * @property string $ip
 * @property string $mac_address
 * @property string $info_gerais
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_conteudos_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzas_ipi_tamanhos
 *
 * @package App\Models
 */
class IpiImpressora extends Eloquent
{
	protected $primaryKey = 'cod_impressoras';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'nome_impressora',
		'ip',
		'mac_address',
		'info_gerais',
		'situacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_conteudos_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiConteudosPizzaria::class, 'cod_impressoras');
	}

	public function ipi_pizzas_ipi_tamanhos()
	{
		return $this->hasMany(\App\Models\IpiPizzasIpiTamanho::class, 'cod_impressoras');
	}
}
