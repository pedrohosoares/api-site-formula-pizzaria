<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTitulo
 * 
 * @property int $cod_titulos
 * @property int $cod_estoque_entrada
 * @property int $cod_pedidos
 * @property int $cod_clientes
 * @property int $cod_titulos_subcategorias
 * @property int $cod_pizzarias
 * @property int $cod_entregadores
 * @property int $cod_colaboradores
 * @property int $cod_fornecedores
 * @property string $descricao
 * @property string $tipo_titulo
 * @property string $tipo_cedente_sacado
 * @property int $total_parcelas
 * @property string $numero_nota_fiscal
 * @property float $total_ipi
 * @property float $total_icms
 * @property float $outras_despesas
 * @property float $desconto
 * @property \Carbon\Carbon $data_hora_criacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiTitulosSubcategoria $ipi_titulos_subcategoria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_titulos_parcelas
 *
 * @package App\Models
 */
class IpiTitulo extends Eloquent
{
	protected $primaryKey = 'cod_titulos';
	public $timestamps = false;

	protected $casts = [
		'cod_estoque_entrada' => 'int',
		'cod_pedidos' => 'int',
		'cod_clientes' => 'int',
		'cod_titulos_subcategorias' => 'int',
		'cod_pizzarias' => 'int',
		'cod_entregadores' => 'int',
		'cod_colaboradores' => 'int',
		'cod_fornecedores' => 'int',
		'total_parcelas' => 'int',
		'total_ipi' => 'float',
		'total_icms' => 'float',
		'outras_despesas' => 'float',
		'desconto' => 'float'
	];

	protected $dates = [
		'data_hora_criacao'
	];

	protected $fillable = [
		'cod_estoque_entrada',
		'cod_pedidos',
		'cod_clientes',
		'cod_titulos_subcategorias',
		'cod_pizzarias',
		'cod_entregadores',
		'cod_colaboradores',
		'cod_fornecedores',
		'descricao',
		'tipo_titulo',
		'tipo_cedente_sacado',
		'total_parcelas',
		'numero_nota_fiscal',
		'total_ipi',
		'total_icms',
		'outras_despesas',
		'desconto',
		'data_hora_criacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_titulos_subcategoria()
	{
		return $this->belongsTo(\App\Models\IpiTitulosSubcategoria::class, 'cod_titulos_subcategorias');
	}

	public function ipi_titulos_parcelas()
	{
		return $this->hasMany(\App\Models\IpiTitulosParcela::class, 'cod_titulos');
	}
}
