<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCombosProduto
 * 
 * @property int $cod_combos_produtos
 * @property int $cod_conteudos
 * @property int $cod_conteudos2
 * @property int $cod_tamanhos
 * @property int $cod_combos
 * @property int $quantidade
 * @property float $preco
 * @property string $tipo
 * @property int $sabor
 * 
 * @property \App\Models\IpiCombo $ipi_combo
 * @property \Illuminate\Database\Eloquent\Collection $ipi_combos_produtos_bebidas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_combos_produtos_bordas
 *
 * @package App\Models
 */
class IpiCombosProduto extends Eloquent
{
	protected $primaryKey = 'cod_combos_produtos';
	public $timestamps = false;

	protected $casts = [
		'cod_conteudos' => 'int',
		'cod_conteudos2' => 'int',
		'cod_tamanhos' => 'int',
		'cod_combos' => 'int',
		'quantidade' => 'int',
		'preco' => 'float',
		'sabor' => 'int'
	];

	protected $fillable = [
		'cod_conteudos',
		'cod_conteudos2',
		'cod_tamanhos',
		'cod_combos',
		'quantidade',
		'preco',
		'tipo',
		'sabor'
	];

	public function ipi_combo()
	{
		return $this->belongsTo(\App\Models\IpiCombo::class, 'cod_combos');
	}

	public function ipi_combos_produtos_bebidas()
	{
		return $this->hasMany(\App\Models\IpiCombosProdutosBebida::class, 'cod_combos_produtos');
	}

	public function ipi_combos_produtos_bordas()
	{
		return $this->hasMany(\App\Models\IpiCombosProdutosBorda::class, 'cod_combos_produtos');
	}
}
