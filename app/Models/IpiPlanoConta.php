<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPlanoConta
 * 
 * @property int $cod_plano_contas
 * @property int $cod_plano_contas_pai
 * @property string $conta_indice
 * @property string $conta_nome
 * @property string $tipo_conta_raiz
 * @property string $tipo_conta
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_titulos_subcategorias_plano_contas
 *
 * @package App\Models
 */
class IpiPlanoConta extends Eloquent
{
	protected $primaryKey = 'cod_plano_contas';
	public $timestamps = false;

	protected $casts = [
		'cod_plano_contas_pai' => 'int'
	];

	protected $fillable = [
		'cod_plano_contas_pai',
		'conta_indice',
		'conta_nome',
		'tipo_conta_raiz',
		'tipo_conta',
		'situacao'
	];

	public function ipi_titulos_subcategorias_plano_contas()
	{
		return $this->hasMany(\App\Models\IpiTitulosSubcategoriasPlanoConta::class, 'cod_plano_contas');
	}
}
