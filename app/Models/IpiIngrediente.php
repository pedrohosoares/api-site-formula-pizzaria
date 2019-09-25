<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngrediente
 * 
 * @property int $cod_ingredientes
 * @property int $cod_ingredientes_troca
 * @property int $cod_ingredientes_baixa
 * @property int $cod_unidade_padrao
 * @property int $cod_titulos_subcategorias
 * @property string $ingrediente
 * @property string $ingrediente_abreviado
 * @property string $foto_grande
 * @property string $foto_pequena
 * @property string $tipo
 * @property string $ingrediente_marca
 * @property int $quantidade
 * @property bool $adicional
 * @property bool $consumo
 * @property string $unidade
 * @property float $indice_perda
 * @property bool $ativo
 * @property bool $destaque
 * @property bool $considerar_cmv
 * @property string $instrucao_entrada
 * @property float $entrada_estoque_maxima
 * @property float $entrada_estoque_minima
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes_estoques
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_ingredientes
 *
 * @package App\Models
 */
class IpiIngrediente extends Eloquent
{
	protected $primaryKey = 'cod_ingredientes';
	public $timestamps = false;

	protected $casts = [
		'cod_ingredientes_troca' => 'int',
		'cod_ingredientes_baixa' => 'int',
		'cod_unidade_padrao' => 'int',
		'cod_titulos_subcategorias' => 'int',
		'quantidade' => 'int',
		'adicional' => 'bool',
		'consumo' => 'bool',
		'indice_perda' => 'float',
		'ativo' => 'bool',
		'destaque' => 'bool',
		'considerar_cmv' => 'bool',
		'entrada_estoque_maxima' => 'float',
		'entrada_estoque_minima' => 'float'
	];

	protected $fillable = [
		'cod_ingredientes_troca',
		'cod_ingredientes_baixa',
		'cod_unidade_padrao',
		'cod_titulos_subcategorias',
		'ingrediente',
		'ingrediente_abreviado',
		'foto_grande',
		'foto_pequena',
		'tipo',
		'ingrediente_marca',
		'quantidade',
		'adicional',
		'consumo',
		'unidade',
		'indice_perda',
		'ativo',
		'destaque',
		'considerar_cmv',
		'instrucao_entrada',
		'entrada_estoque_maxima',
		'entrada_estoque_minima'
	];

	public function ipi_ingredientes_estoques()
	{
		return $this->hasMany(\App\Models\IpiIngredientesEstoque::class, 'cod_ingredientes');
	}

	public function ipi_pizzas()
	{
		return $this->belongsToMany(\App\Models\IpiPizza::class, 'ipi_ingredientes_ipi_pizzas', 'cod_ingredientes', 'cod_pizzas');
	}

	public function ipi_tamanhos()
	{
		return $this->belongsToMany(\App\Models\IpiTamanho::class, 'ipi_ingredientes_ipi_tamanhos', 'cod_ingredientes', 'cod_tamanhos')
					->withPivot('cod_pizzarias', 'preco', 'valor_imposto', 'preco_troca', 'pontos_fidelidade', 'quantidade_estoque_extra');
	}

	public function ipi_ingredientes_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiIngredientesPizzaria::class, 'cod_ingredientes');
	}

	public function ipi_pedidos_ingredientes()
	{
		return $this->hasMany(\App\Models\IpiPedidosIngrediente::class, 'cod_ingredientes');
	}
}
