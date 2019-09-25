<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiClientesBloqueio
 * 
 * @property int $cod_clientes_bloqueio
 * @property int $cod_pizzarias
 * @property int $cod_usuarios_alteracao
 * @property int $cod_usuarios_bloqueio
 * @property int $cod_clientes
 * @property \Carbon\Carbon $data_hora_bloqueio
 * @property \Carbon\Carbon $data_hora_alteracao
 * @property string $obs
 * @property string $tipo_bloqueio
 * @property string $email
 * @property string $cpf
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $bandeira
 * @property string $numero_cartao
 * @property string $cartao_compacto
 * @property string $endereco_compacto
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_clientes_bloqueio_logs
 *
 * @package App\Models
 */
class IpiClientesBloqueio extends Eloquent
{
	protected $table = 'ipi_clientes_bloqueio';
	protected $primaryKey = 'cod_clientes_bloqueio';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_usuarios_alteracao' => 'int',
		'cod_usuarios_bloqueio' => 'int',
		'cod_clientes' => 'int'
	];

	protected $dates = [
		'data_hora_bloqueio',
		'data_hora_alteracao'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_usuarios_alteracao',
		'cod_usuarios_bloqueio',
		'cod_clientes',
		'data_hora_bloqueio',
		'data_hora_alteracao',
		'obs',
		'tipo_bloqueio',
		'email',
		'cpf',
		'endereco',
		'numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'bandeira',
		'numero_cartao',
		'cartao_compacto',
		'endereco_compacto',
		'situacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_clientes_bloqueio_logs()
	{
		return $this->hasMany(\App\Models\IpiClientesBloqueioLog::class, 'cod_clientes_bloqueio');
	}
}
