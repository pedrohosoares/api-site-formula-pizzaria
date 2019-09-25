<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCupon
 * 
 * @property int $cod_cupons
 * @property string $cupom
 * @property \Carbon\Carbon $data_inicio
 * @property \Carbon\Carbon $data_validade
 * @property \Carbon\Carbon $data_hora_cupom
 * @property bool $valido
 * @property string $produto
 * @property int $cod_produtos
 * @property int $cod_tamanhos
 * @property int $cod_clientes
 * @property bool $sorteio
 * @property \Carbon\Carbon $data_sorteio
 * @property bool $promocao
 * @property bool $necessita_compra
 * @property float $valor_minimo_compra
 * @property string $usuario_criacao
 * @property bool $generico
 * @property string $obs_cupom
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzarias_cupons
 *
 * @package App\Models
 */
class IpiCupon extends Eloquent
{
	protected $primaryKey = 'cod_cupons';
	public $timestamps = false;

	protected $casts = [
		'valido' => 'bool',
		'cod_produtos' => 'int',
		'cod_tamanhos' => 'int',
		'cod_clientes' => 'int',
		'sorteio' => 'bool',
		'promocao' => 'bool',
		'necessita_compra' => 'bool',
		'valor_minimo_compra' => 'float',
		'generico' => 'bool'
	];

	protected $dates = [
		'data_inicio',
		'data_validade',
		'data_hora_cupom',
		'data_sorteio'
	];

	protected $fillable = [
		'cupom',
		'data_inicio',
		'data_validade',
		'data_hora_cupom',
		'valido',
		'produto',
		'cod_produtos',
		'cod_tamanhos',
		'cod_clientes',
		'sorteio',
		'data_sorteio',
		'promocao',
		'necessita_compra',
		'valor_minimo_compra',
		'usuario_criacao',
		'generico',
		'obs_cupom'
	];

	public function ipi_pedidos()
	{
		return $this->belongsToMany(\App\Models\IpiPedido::class, 'ipi_pedidos_ipi_cupons', 'cod_cupons', 'cod_pedidos');
	}

	public function ipi_pizzarias_cupons()
	{
		return $this->hasMany(\App\Models\IpiPizzariasCupon::class, 'cod_cupons');
	}
}
