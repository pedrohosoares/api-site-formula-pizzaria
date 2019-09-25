<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanho
 * 
 * @property int $cod_tamanhos
 * @property string $tamanho
 * @property string $situacao
 * @property string $cod_barras
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_cpvs
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes_estoques
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_pizzas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_adicionais
 * @property \Illuminate\Database\Eloquent\Collection $ipi_bordas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_fracoes_precos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_opcoes_cortes
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tipo_massas
 *
 * @package App\Models
 */
class IpiTamanho extends Eloquent
{
	protected $primaryKey = 'cod_tamanhos';
	public $timestamps = false;

	protected $fillable = [
		'tamanho',
		'situacao',
		'cod_barras'
	];

	public function ipi_cpvs()
	{
		return $this->hasMany(\App\Models\IpiCpv::class, 'cod_tamanhos');
	}

	public function ipi_ingredientes_estoques()
	{
		return $this->hasMany(\App\Models\IpiIngredientesEstoque::class, 'cod_tamanhos');
	}

	public function ipi_ingredientes()
	{
		return $this->belongsToMany(\App\Models\IpiIngrediente::class, 'ipi_ingredientes_ipi_tamanhos', 'cod_tamanhos', 'cod_ingredientes')
					->withPivot('cod_pizzarias', 'preco', 'valor_imposto', 'preco_troca', 'pontos_fidelidade', 'quantidade_estoque_extra');
	}

	public function ipi_pedidos_pizzas()
	{
		return $this->hasMany(\App\Models\IpiPedidosPizza::class, 'cod_tamanhos');
	}

	public function ipi_pizzas()
	{
		return $this->belongsToMany(\App\Models\IpiPizza::class, 'ipi_pizzas_ipi_tamanhos', 'cod_tamanhos', 'cod_pizzas')
					->withPivot('preco', 'valor_imposto', 'pontos_fidelidade', 'cod_pizzarias', 'cod_impressoras', 'pizza_semana', 'pizza_dia');
	}

	public function ipi_adicionais()
	{
		return $this->belongsToMany(\App\Models\IpiAdicionai::class, 'ipi_tamanhos_ipi_adicionais', 'cod_tamanhos', 'cod_adicionais')
					->withPivot('cod_pizzarias', 'preco', 'selecao_padrao_adicional', 'valor_imposto');
	}

	public function ipi_bordas()
	{
		return $this->belongsToMany(\App\Models\IpiBorda::class, 'ipi_tamanhos_ipi_bordas', 'cod_tamanhos', 'cod_bordas')
					->withPivot('cod_pizzarias', 'preco', 'valor_imposto', 'pontos_fidelidade', 'selecao_padrao_borda');
	}

	public function ipi_fracoes_precos()
	{
		return $this->belongsToMany(\App\Models\IpiFracoesPreco::class, 'ipi_tamanhos_ipi_fracoes_precos', 'cod_tamanhos', 'cod_fracoes_precos')
					->withPivot('preco');
	}

	public function ipi_opcoes_cortes()
	{
		return $this->belongsToMany(\App\Models\IpiOpcoesCorte::class, 'ipi_tamanhos_ipi_opcoes_corte', 'cod_tamanhos', 'cod_opcoes_corte')
					->withPivot('preco', 'tamanho_padrao', 'selecao_padrao_corte');
	}

	public function ipi_tipo_massas()
	{
		return $this->belongsToMany(\App\Models\IpiTipoMassa::class, 'ipi_tamanhos_ipi_tipo_massa', 'cod_tamanhos', 'cod_tipo_massa')
					->withPivot('preco', 'selecao_padrao_massa');
	}
}
