<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizza
 * 
 * @property int $cod_pizzas
 * @property int $cod_tipo_pizza
 * @property string $pizza
 * @property string $tipo
 * @property int $clicks
 * @property int $visualizacoes
 * @property string $foto_pequena
 * @property string $foto_grande
 * @property bool $sugestao
 * @property bool $novidade
 * @property bool $pizza_fit
 * @property bool $venda_online
 * @property string $codigo_cliente_pizza
 * @property int $ncm
 * @property int $cest
 * @property string $cfop
 * @property int $cst_icms
 * @property string $cst_icms_ecf
 * @property int $cst_pis_cofins
 * @property float $aliq_icms
 * @property string $cod_barras
 * @property int $id_icms_ecf
 * @property int $id_pis_cofins_ecf
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_cardapios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_cpvs
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes_estoques
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_fracos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos
 *
 * @package App\Models
 */
class IpiPizza extends Eloquent
{
	protected $primaryKey = 'cod_pizzas';
	public $timestamps = false;

	protected $casts = [
		'cod_tipo_pizza' => 'int',
		'clicks' => 'int',
		'visualizacoes' => 'int',
		'sugestao' => 'bool',
		'novidade' => 'bool',
		'pizza_fit' => 'bool',
		'venda_online' => 'bool',
		'ncm' => 'int',
		'cest' => 'int',
		'cst_icms' => 'int',
		'cst_pis_cofins' => 'int',
		'aliq_icms' => 'float',
		'id_icms_ecf' => 'int',
		'id_pis_cofins_ecf' => 'int'
	];

	protected $fillable = [
		'cod_tipo_pizza',
		'pizza',
		'tipo',
		'clicks',
		'visualizacoes',
		'foto_pequena',
		'foto_grande',
		'sugestao',
		'novidade',
		'pizza_fit',
		'venda_online',
		'codigo_cliente_pizza',
		'ncm',
		'cest',
		'cfop',
		'cst_icms',
		'cst_icms_ecf',
		'cst_pis_cofins',
		'aliq_icms',
		'cod_barras',
		'id_icms_ecf',
		'id_pis_cofins_ecf'
	];

	public function ipi_cardapios()
	{
		return $this->hasMany(\App\Models\IpiCardapio::class, 'cod_pizzas');
	}

	public function ipi_cpvs()
	{
		return $this->hasMany(\App\Models\IpiCpv::class, 'cod_pizzas');
	}

	public function ipi_ingredientes_estoques()
	{
		return $this->hasMany(\App\Models\IpiIngredientesEstoque::class, 'cod_pizzas');
	}

	public function ipi_ingredientes()
	{
		return $this->belongsToMany(\App\Models\IpiIngrediente::class, 'ipi_ingredientes_ipi_pizzas', 'cod_pizzas', 'cod_ingredientes');
	}

	public function ipi_pedidos_fracos()
	{
		return $this->hasMany(\App\Models\IpiPedidosFraco::class, 'cod_pizzas');
	}

	public function ipi_tamanhos()
	{
		return $this->belongsToMany(\App\Models\IpiTamanho::class, 'ipi_pizzas_ipi_tamanhos', 'cod_pizzas', 'cod_tamanhos')
					->withPivot('preco', 'valor_imposto', 'pontos_fidelidade', 'cod_pizzarias', 'cod_impressoras', 'pizza_semana', 'pizza_dia');
	}
}
