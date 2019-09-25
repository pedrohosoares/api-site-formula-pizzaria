<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCombosProdutosBebida
 * 
 * @property int $cod_combos_produtos_bebidas
 * @property int $cod_combos_produtos
 * @property int $cod_bebidas_ipi_conteudos
 * 
 * @property \App\Models\IpiBebidasIpiConteudo $ipi_bebidas_ipi_conteudo
 * @property \App\Models\IpiCombosProduto $ipi_combos_produto
 *
 * @package App\Models
 */
class IpiCombosProdutosBebida extends Eloquent
{
	protected $primaryKey = 'cod_combos_produtos_bebidas';
	public $timestamps = false;

	protected $casts = [
		'cod_combos_produtos' => 'int',
		'cod_bebidas_ipi_conteudos' => 'int'
	];

	protected $fillable = [
		'cod_combos_produtos',
		'cod_bebidas_ipi_conteudos'
	];

	public function ipi_bebidas_ipi_conteudo()
	{
		return $this->belongsTo(\App\Models\IpiBebidasIpiConteudo::class, 'cod_bebidas_ipi_conteudos');
	}

	public function ipi_combos_produto()
	{
		return $this->belongsTo(\App\Models\IpiCombosProduto::class, 'cod_combos_produtos');
	}
}
