<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCombosPizzaria
 * 
 * @property int $cod_pizzarias
 * @property int $cod_combos
 * @property float $preco
 * @property int $pontos_fidelidade
 * @property string $imagem_final
 * 
 * @property \App\Models\IpiCombo $ipi_combo
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiCombosPizzaria extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_combos' => 'int',
		'preco' => 'float',
		'pontos_fidelidade' => 'int'
	];

	protected $fillable = [
		'preco',
		'pontos_fidelidade',
		'imagem_final'
	];

	public function ipi_combo()
	{
		return $this->belongsTo(\App\Models\IpiCombo::class, 'cod_combos');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
