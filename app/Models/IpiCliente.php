<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCliente
 * 
 * @property int $cod_clientes
 * @property int $cod_vip
 * @property int $cod_onde_conheceu
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property string $cpf
 * @property string $celular
 * @property \Carbon\Carbon $ultimo_acesso
 * @property bool $indicador_recebeu_pontos
 * @property int $cod_clientes_indicador
 * @property string $observacao
 * @property \Carbon\Carbon $nascimento
 * @property string $sexo
 * @property string $origem_cliente
 * @property \Carbon\Carbon $data_hora_cadastro
 * @property string $situacao
 * @property string $id_ifood_cliente
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_clientes_bloqueio_logs
 * @property \Illuminate\Database\Eloquent\Collection $ipi_enquete_respostas
 * @property \App\Models\IpiClientesRedesSociai $ipi_clientes_redes_sociai
 * @property \Illuminate\Database\Eloquent\Collection $ipi_email_automaticos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_enderecos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_fidelidade_clientes
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_telemarketing_ativo_respostas
 *
 * @package App\Models
 */
class IpiCliente extends Eloquent
{
	protected $primaryKey = 'cod_clientes';
	public $timestamps = false;

	protected $casts = [
		'cod_vip' => 'int',
		'cod_onde_conheceu' => 'int',
		'indicador_recebeu_pontos' => 'bool',
		'cod_clientes_indicador' => 'int'
	];

	protected $dates = [
		'ultimo_acesso',
		'nascimento',
		'data_hora_cadastro'
	];

	protected $fillable = [
		'cod_vip',
		'cod_onde_conheceu',
		'nome',
		'email',
		'senha',
		'cpf',
		'celular',
		'ultimo_acesso',
		'indicador_recebeu_pontos',
		'cod_clientes_indicador',
		'observacao',
		'nascimento',
		'sexo',
		'origem_cliente',
		'data_hora_cadastro',
		'situacao',
		'id_ifood_cliente'
	];

	public function ipi_clientes_bloqueio_logs()
	{
		return $this->hasMany(\App\Models\IpiClientesBloqueioLog::class, 'cod_clientes');
	}

	public function ipi_enquete_respostas()
	{
		return $this->belongsToMany(\App\Models\IpiEnqueteResposta::class, 'ipi_clientes_ipi_enquete_respostas', 'cod_clientes', 'cod_enquete_respostas')
					->withPivot('cod_clientes_ipi_enquete_respostas', 'justificativa', 'data_hora_resposta', 'cod_pedidos', 'cod_usuarios', 'data_hora_resposta_pizzaria', 'resposta_pizzaria', 'respondida_pizzaria', 'respondida_pizzaria_tel');
	}

	public function ipi_clientes_redes_sociai()
	{
		return $this->hasMany(\App\Models\IpiClientesRedesSociai::class, 'cod_clientes');
	}

	public function ipi_email_automaticos()
	{
		return $this->hasMany(\App\Models\IpiEmailAutomatico::class, 'cod_clientes');
	}

	public function ipi_enderecos()
	{
		return $this->hasMany(\App\Models\IpiEndereco::class, 'cod_clientes','cod_clientes');
	}

	public function ipi_fidelidade_clientes()
	{
		return $this->hasMany(\App\Models\IpiFidelidadeCliente::class, 'cod_clientes');
	}

	public function ipi_pedidos()
	{
		return $this->hasMany(\App\Models\IpiPedido::class, 'cod_clientes');
	}

	public function ipi_telemarketing_ativo_respostas()
	{
		return $this->hasMany(\App\Models\IpiTelemarketingAtivoResposta::class, 'cod_clientes');
	}
}
