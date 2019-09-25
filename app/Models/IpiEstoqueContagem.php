<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEstoqueContagem
 * 
 * @property int $cod_inventarios
 * @property int $cod_ingredientes
 * @property int $cod_bebidas_ipi_conteudos
 * @property float $quantidade1
 * @property float $quantidade2
 * @property float $quantidade3
 * @property float $quantidade_ajuste
 * @property string $observacao
 * @property string $tipo_contagem
 * @property \Carbon\Carbon $data_hora_contagem1
 * @property \Carbon\Carbon $data_hora_contagem2
 * @property \Carbon\Carbon $data_hora_contagem3
 * 
 * @property \App\Models\IpiEstoqueInventario $ipi_estoque_inventario
 *
 * @package App\Models
 */
class IpiEstoqueContagem extends Eloquent
{
	protected $table = 'ipi_estoque_contagem';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_inventarios' => 'int',
		'cod_ingredientes' => 'int',
		'cod_bebidas_ipi_conteudos' => 'int',
		'quantidade1' => 'float',
		'quantidade2' => 'float',
		'quantidade3' => 'float',
		'quantidade_ajuste' => 'float'
	];

	protected $dates = [
		'data_hora_contagem1',
		'data_hora_contagem2',
		'data_hora_contagem3'
	];

	protected $fillable = [
		'cod_inventarios',
		'cod_ingredientes',
		'cod_bebidas_ipi_conteudos',
		'quantidade1',
		'quantidade2',
		'quantidade3',
		'quantidade_ajuste',
		'observacao',
		'tipo_contagem',
		'data_hora_contagem1',
		'data_hora_contagem2',
		'data_hora_contagem3'
	];

	public function ipi_estoque_inventario()
	{
		return $this->belongsTo(\App\Models\IpiEstoqueInventario::class, 'cod_inventarios', 'cod_inventarios');
	}
}
