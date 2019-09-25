<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiClientesInformacao
 * 
 * @property int $cod_informacao
 * @property string $email_enviar
 * @property int $cod_clientes
 * @property int $cod_pedidos
 * @property string $tipo_log
 * @property string $problema_reclamado
 * @property \Carbon\Carbon $data_envio
 * @property \Carbon\Carbon $data_resposta
 * @property string $nome_navegador
 * @property string $versao_navegador
 * @property string $idioma
 * @property string $nome_plataforma
 * @property string $user_agent
 * @property string $informacao_extra
 * @property string $sessao
 *
 * @package App\Models
 */
class IpiClientesInformacao extends Eloquent
{
	protected $table = 'ipi_clientes_informacao';
	protected $primaryKey = 'cod_informacao';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_pedidos' => 'int'
	];

	protected $dates = [
		'data_envio',
		'data_resposta'
	];

	protected $fillable = [
		'email_enviar',
		'cod_clientes',
		'cod_pedidos',
		'tipo_log',
		'problema_reclamado',
		'data_envio',
		'data_resposta',
		'nome_navegador',
		'versao_navegador',
		'idioma',
		'nome_plataforma',
		'user_agent',
		'informacao_extra',
		'sessao'
	];
}
