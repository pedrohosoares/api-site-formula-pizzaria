<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFidelidadeCliente
 * 
 * @property int $cod_fidelidade_clientes
 * @property int $cod_clientes
 * @property int $cod_usuarios
 * @property int $cod_pedidos
 * @property \Carbon\Carbon $data_hora_fidelidade
 * @property \Carbon\Carbon $data_validade
 * @property int $pontos
 * @property string $obs
 * 
 * @property \App\Models\IpiCliente $ipi_cliente
 *
 * @package App\Models
 */
class IpiFidelidadeCliente extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_usuarios' => 'int',
		'cod_pedidos' => 'int',
		'pontos' => 'int'
	];

	protected $dates = [
		'data_hora_fidelidade',
		'data_validade'
	];

	protected $fillable = [
		'cod_usuarios',
		'cod_pedidos',
		'data_hora_fidelidade',
		'data_validade',
		'pontos',
		'obs'
	];

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}
}
