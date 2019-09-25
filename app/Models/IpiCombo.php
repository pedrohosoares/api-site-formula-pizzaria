<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCombo
 * 
 * @property int $cod_combos
 * @property string $nome_combo
 * @property string $descricao_combo
 * @property string $imagem_p
 * @property string $imagem_g
 * @property string $imagem_fundo
 * @property string $cor_combo
 * @property int $ordem_combo
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_combos_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_combos_produtos
 *
 * @package App\Models
 */
class IpiCombo extends Eloquent
{
	protected $primaryKey = 'cod_combos';
	public $timestamps = false;

	protected $casts = [
		'ordem_combo' => 'int'
	];

	protected $fillable = [
		'nome_combo',
		'descricao_combo',
		'imagem_p',
		'imagem_g',
		'imagem_fundo',
		'cor_combo',
		'ordem_combo',
		'situacao'
	];

	public function ipi_combos_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiCombosPizzaria::class, 'cod_combos');
	}

	public function ipi_combos_produtos()
	{
		return $this->hasMany(\App\Models\IpiCombosProduto::class, 'cod_combos');
	}
}
