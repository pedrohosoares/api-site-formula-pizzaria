<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEndereco
 * 
 * @property int $cod_enderecos
 * @property int $cod_clientes
 * @property string $apelido
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $telefone_1
 * @property string $telefone_2
 * @property string $edificio
 * @property string $referencia_endereco
 * @property string $referencia_cliente
 * @property string $obs_endereco
 * 
 * @property \App\Models\IpiCliente $ipi_cliente
 *
 * @package App\Models
 */
class IpiEndereco extends Eloquent
{
	protected $primaryKey = 'cod_enderecos';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int'
	];

	protected $fillable = [
		'apelido',
		'endereco',
		'numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'telefone_1',
		'telefone_2',
		'edificio',
		'referencia_endereco',
		'referencia_cliente',
		'obs_endereco'
	];

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}
}
