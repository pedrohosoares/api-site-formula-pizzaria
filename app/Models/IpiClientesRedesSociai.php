<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiClientesRedesSociai
 * 
 * @property int $cod_clientes
 * @property string $nome_site
 * @property string $url_cliente_site
 * @property string $hash_acesso_cliente_site
 * @property string $rs_email
 * @property string $rs_nome
 * @property \Carbon\Carbon $rs_nascimento
 * @property string $rs_foto
 * @property string $rs_sexo
 * @property \Carbon\Carbon $data_vinculacao
 * @property string $status
 * 
 * @property \App\Models\IpiCliente $ipi_cliente
 *
 * @package App\Models
 */
class IpiClientesRedesSociai extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int'
	];

	protected $dates = [
		'rs_nascimento',
		'data_vinculacao'
	];

	protected $fillable = [
		'cod_clientes',
		'nome_site',
		'url_cliente_site',
		'hash_acesso_cliente_site',
		'rs_email',
		'rs_nome',
		'rs_nascimento',
		'rs_foto',
		'rs_sexo',
		'data_vinculacao',
		'status'
	];

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}
}
