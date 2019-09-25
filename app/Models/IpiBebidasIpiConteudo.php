<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiBebidasIpiConteudo
 * 
 * @property int $cod_bebidas_ipi_conteudos
 * @property int $cod_bebidas
 * @property int $cod_conteudos
 * @property string $codigo_cliente_bebida
 * @property int $quantidade_embalagem
 * @property string $situacao
 * @property string $foto_pequena
 * @property string $foto_grande
 * @property int $cod_unidade_padrao
 * @property string $ncm
 * @property string $cest
 * @property string $cfop
 * @property int $cst_icms
 * @property string $cst_icms_ecf
 * @property int $cst_pis_cofins
 * @property float $aliq_icms
 * 
 * @property \App\Models\IpiConteudo $ipi_conteudo
 * @property \App\Models\IpiBebida $ipi_bebida
 * @property \Illuminate\Database\Eloquent\Collection $ipi_combos_produtos_bebidas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_bebidas
 *
 * @package App\Models
 */
class IpiBebidasIpiConteudo extends Eloquent
{
	protected $primaryKey = 'cod_bebidas_ipi_conteudos';
	public $timestamps = false;

	protected $casts = [
		'cod_bebidas' => 'int',
		'cod_conteudos' => 'int',
		'quantidade_embalagem' => 'int',
		'cod_unidade_padrao' => 'int',
		'cst_icms' => 'int',
		'cst_pis_cofins' => 'int',
		'aliq_icms' => 'float'
	];

	protected $fillable = [
		'cod_bebidas',
		'cod_conteudos',
		'codigo_cliente_bebida',
		'quantidade_embalagem',
		'situacao',
		'foto_pequena',
		'foto_grande',
		'cod_unidade_padrao',
		'ncm',
		'cest',
		'cfop',
		'cst_icms',
		'cst_icms_ecf',
		'cst_pis_cofins',
		'aliq_icms'
	];

	public function ipi_conteudo()
	{
		return $this->belongsTo(\App\Models\IpiConteudo::class, 'cod_conteudos');
	}

	public function ipi_bebida()
	{
		return $this->belongsTo(\App\Models\IpiBebida::class, 'cod_bebidas');
	}

	public function ipi_combos_produtos_bebidas()
	{
		return $this->hasMany(\App\Models\IpiCombosProdutosBebida::class, 'cod_bebidas_ipi_conteudos');
	}

	public function ipi_pedidos_bebidas()
	{
		return $this->hasMany(\App\Models\IpiPedidosBebida::class, 'cod_bebidas_ipi_conteudos');
	}
}
