<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosDetalhesPg
 * 
 * @property int $cod_pedidos_detalhes_pg
 * @property int $cod_pedidos
 * @property string $chave
 * @property string $conteudo
 * 
 * @property \App\Models\IpiPedido $ipi_pedido
 *
 * @package App\Models
 */
class IpiPedidosDetalhesPg extends Eloquent
{
	protected $table = 'ipi_pedidos_detalhes_pg';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int'
	];

	protected $fillable = [
		'chave',
		'conteudo'
	];

	public function ipi_pedido()
	{
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pedidos');
	}
}
