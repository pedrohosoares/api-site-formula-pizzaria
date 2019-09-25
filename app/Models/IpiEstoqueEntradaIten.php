<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEstoqueEntradaIten
 * 
 * @property int $cod_estoque_entrada_itens
 * @property int $cod_estoque_entrada
 * @property int $cod_bebidas_ipi_conteudos
 * @property int $cod_ingredientes
 * @property string $tipo_entrada_estoque
 * @property int $entrada_fora_limites
 * @property int $quantidade_entrada
 * @property int $quantidade_embalagem_entrada
 * @property float $preco_unitario_entrada
 * @property float $preco_unitario_sem_desconto
 * @property float $preco_total_entrada
 * @property float $valor_desconto
 * 
 * @property \App\Models\IpiEstoqueEntrada $ipi_estoque_entrada
 *
 * @package App\Models
 */
class IpiEstoqueEntradaIten extends Eloquent
{
	protected $primaryKey = 'cod_estoque_entrada_itens';
	public $timestamps = false;

	protected $casts = [
		'cod_estoque_entrada' => 'int',
		'cod_bebidas_ipi_conteudos' => 'int',
		'cod_ingredientes' => 'int',
		'entrada_fora_limites' => 'int',
		'quantidade_entrada' => 'int',
		'quantidade_embalagem_entrada' => 'int',
		'preco_unitario_entrada' => 'float',
		'preco_unitario_sem_desconto' => 'float',
		'preco_total_entrada' => 'float',
		'valor_desconto' => 'float'
	];

	protected $fillable = [
		'cod_estoque_entrada',
		'cod_bebidas_ipi_conteudos',
		'cod_ingredientes',
		'tipo_entrada_estoque',
		'entrada_fora_limites',
		'quantidade_entrada',
		'quantidade_embalagem_entrada',
		'preco_unitario_entrada',
		'preco_unitario_sem_desconto',
		'preco_total_entrada',
		'valor_desconto'
	];

	public function ipi_estoque_entrada()
	{
		return $this->belongsTo(\App\Models\IpiEstoqueEntrada::class, 'cod_estoque_entrada');
	}
}
