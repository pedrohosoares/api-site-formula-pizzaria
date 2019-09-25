<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCombosProdutosBorda
 * 
 * @property int $cod_combos_produtos_bordas
 * @property int $cod_combos_produtos
 * @property int $cod_tamanhos
 * @property int $cod_bordas
 * 
 * @property \App\Models\IpiCombosProduto $ipi_combos_produto
 * @property \App\Models\IpiTamanhosIpiBorda $ipi_tamanhos_ipi_borda
 *
 * @package App\Models
 */
class IpiCombosProdutosBorda extends Eloquent
{
	protected $primaryKey = 'cod_combos_produtos_bordas';
	public $timestamps = false;

	protected $casts = [
		'cod_combos_produtos' => 'int',
		'cod_tamanhos' => 'int',
		'cod_bordas' => 'int'
	];

	protected $fillable = [
		'cod_combos_produtos',
		'cod_tamanhos',
		'cod_bordas'
	];

	public function ipi_combos_produto()
	{
		return $this->belongsTo(\App\Models\IpiCombosProduto::class, 'cod_combos_produtos');
	}

	public function ipi_tamanhos_ipi_borda()
	{
		return $this->belongsTo(\App\Models\IpiTamanhosIpiBorda::class, 'cod_bordas');
	}
}
