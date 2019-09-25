<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzaria
 * 
 * @property int $cod_pizzarias
 * @property int $cod_empresas
 * @property string $nome
 * @property string $telefone_1
 * @property string $telefone_2
 * @property string $telefone_3
 * @property string $telefone_4
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $horarios
 * @property \Carbon\Carbon $horario_inicial
 * @property \Carbon\Carbon $horario_final
 * @property float $lat
 * @property float $lon
 * @property string $emails_diretoria
 * @property string $foto_grande
 * @property string $foto_pequena
 * @property string $num_afiliacao_cartao
 * @property string $num_gateway_pagamento
 * @property string $chave_cielo
 * @property bool $impressao_automatica
 * @property string $cnpj
 * @property string $inscricao_estadual
 * @property string $nome_fantasia
 * @property string $razao_social
 * @property \Carbon\Carbon $data_inauguracao
 * @property int $debug_pedidos
 * @property string $timezone
 * @property string $situacao
 * @property string $usuario_srv
 * @property string $senha_srv
 * @property string $print_node_impressora
 * @property string $print_node_impressora2
 * @property string $dados_extra
 * @property string $merchant_id
 * @property int $ifood_ligado
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_bancos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_caixas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_cardapios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ceps
 * @property \Illuminate\Database\Eloquent\Collection $ipi_clientes_bloqueios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_colaboradores
 * @property \Illuminate\Database\Eloquent\Collection $ipi_combos_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_conteudos_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_cpvs
 * @property \Illuminate\Database\Eloquent\Collection $ipi_entregadores
 * @property \Illuminate\Database\Eloquent\Collection $ipi_estoques
 * @property \Illuminate\Database\Eloquent\Collection $ipi_estoque_entradas
 * @property \App\Models\IpiEstoqueMapa $ipi_estoque_mapa
 * @property \Illuminate\Database\Eloquent\Collection $ipi_formas_pg_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_franqueados
 * @property \Illuminate\Database\Eloquent\Collection $ipi_impressoras
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes_ipi_tamanhos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_ingredientes_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_mensagem_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_merchants
 * @property \Illuminate\Database\Eloquent\Collection $ipi_mesas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_mesas_taxas_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzarias_cupons
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzarias_estatisticas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzarias_funcionamentos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzarias_horarios
 * @property \Illuminate\Database\Eloquent\Collection $nuc_usuarios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzas_ipi_tamanhos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos_ipi_adicionais
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos_ipi_bordas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_telemarketing_ativos
 * @property \Illuminate\Database\Eloquent\Collection $ipi_titulos
 *
 * @package App\Models
 */
class IpiPizzaria extends Eloquent
{
	protected $primaryKey = 'cod_pizzarias';
	public $timestamps = false;

	protected $casts = [
		'cod_empresas' => 'int',
		'lat' => 'float',
		'lon' => 'float',
		'impressao_automatica' => 'bool',
		'debug_pedidos' => 'int',
		'ifood_ligado' => 'int'
	];

	protected $dates = [
		'horario_inicial',
		'horario_final',
		'data_inauguracao'
	];

	protected $fillable = [
		'cod_empresas',
		'nome',
		'telefone_1',
		'telefone_2',
		'telefone_3',
		'telefone_4',
		'endereco',
		'numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'horarios',
		'horario_inicial',
		'horario_final',
		'lat',
		'lon',
		'emails_diretoria',
		'foto_grande',
		'foto_pequena',
		'num_afiliacao_cartao',
		'num_gateway_pagamento',
		'chave_cielo',
		'impressao_automatica',
		'cnpj',
		'inscricao_estadual',
		'nome_fantasia',
		'razao_social',
		'data_inauguracao',
		'debug_pedidos',
		'timezone',
		'situacao',
		'usuario_srv',
		'senha_srv',
		'print_node_impressora',
		'print_node_impressora2',
		'dados_extra',
		'merchant_id',
		'ifood_ligado'
	];

	public function ipi_pedidos(){
		return $this->hasMany(\App\Models\IpiPedido::class, 'cod_pizzarias');
	}

	public function ipi_bancos()
	{
		return $this->belongsToMany(\App\Models\IpiBanco::class, 'ipi_bancos_ipi_pizzarias', 'cod_pizzarias', 'cod_bancos')
					->withPivot('cod_bancos_pizzarias');
	}

	public function ipi_caixas()
	{
		return $this->hasMany(\App\Models\IpiCaixa::class, 'cod_pizzarias');
	}

	public function ipi_cardapios()
	{
		return $this->hasMany(\App\Models\IpiCardapio::class, 'cod_pizzarias');
	}

	public function ipi_ceps()
	{
		return $this->hasMany(\App\Models\IpiCep::class, 'cod_pizzarias');
	}

	public function ipi_clientes_bloqueios()
	{
		return $this->hasMany(\App\Models\IpiClientesBloqueio::class, 'cod_pizzarias');
	}

	public function ipi_colaboradores()
	{
		return $this->hasMany(\App\Models\IpiColaboradore::class, 'cod_pizzarias');
	}

	public function ipi_combos_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiCombosPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_conteudos_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiConteudosPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_cpvs()
	{
		return $this->hasMany(\App\Models\IpiCpv::class, 'cod_pizzarias');
	}

	public function ipi_entregadores()
	{
		return $this->hasMany(\App\Models\IpiEntregadore::class, 'cod_pizzarias');
	}

	public function ipi_estoques()
	{
		return $this->hasMany(\App\Models\IpiEstoque::class, 'cod_pizzarias');
	}

	public function ipi_estoque_entradas()
	{
		return $this->hasMany(\App\Models\IpiEstoqueEntrada::class, 'cod_pizzarias');
	}

	public function ipi_estoque_mapa()
	{
		return $this->hasOne(\App\Models\IpiEstoqueMapa::class, 'cod_pizzarias');
	}

	public function ipi_formas_pg_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiFormasPgPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_franqueados()
	{
		return $this->hasMany(\App\Models\IpiFranqueado::class, 'cod_pizzarias');
	}

	public function ipi_impressoras()
	{
		return $this->hasMany(\App\Models\IpiImpressora::class, 'cod_pizzarias');
	}

	public function ipi_ingredientes_ipi_tamanhos()
	{
		return $this->hasMany(\App\Models\IpiIngredientesIpiTamanho::class, 'cod_pizzarias');
	}

	public function ipi_ingredientes_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiIngredientesPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_mensagem_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiMensagemPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_merchants()
	{
		return $this->hasMany(\App\Models\IpiMerchant::class, 'cod_pizzarias');
	}

	public function ipi_mesas()
	{
		return $this->hasMany(\App\Models\IpiMesa::class, 'cod_pizzarias');
	}

	public function ipi_mesas_taxas_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiMesasTaxasPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_pizzarias_cupons()
	{
		return $this->hasMany(\App\Models\IpiPizzariasCupon::class, 'cod_pizzarias');
	}

	public function ipi_pizzarias_estatisticas()
	{
		return $this->hasMany(\App\Models\IpiPizzariasEstatistica::class, 'cod_pizzarias');
	}

	public function ipi_pizzarias_funcionamentos()
	{
		return $this->hasMany(\App\Models\IpiPizzariasFuncionamento::class, 'cod_pizzarias');
	}

	public function ipi_pizzarias_horarios()
	{
		return $this->hasMany(\App\Models\IpiPizzariasHorario::class, 'cod_pizzarias');
	}

	public function nuc_usuarios()
	{
		return $this->belongsToMany(\App\Models\NucUsuario::class, 'ipi_pizzarias_nuc_usuarios', 'cod_pizzarias', 'cod_usuarios');
	}

	public function ipi_pizzas_ipi_tamanhos()
	{
		return $this->hasMany(\App\Models\IpiPizzasIpiTamanho::class, 'cod_pizzarias');
	}

	public function ipi_tamanhos_ipi_adicionais()
	{
		return $this->hasMany(\App\Models\IpiTamanhosIpiAdicionai::class, 'cod_pizzarias');
	}

	public function ipi_tamanhos_ipi_bordas()
	{
		return $this->hasMany(\App\Models\IpiTamanhosIpiBorda::class, 'cod_pizzarias');
	}

	public function ipi_telemarketing_ativos()
	{
		return $this->hasMany(\App\Models\IpiTelemarketingAtivo::class, 'cod_pizzarias');
	}

	public function ipi_titulos()
	{
		return $this->hasMany(\App\Models\IpiTitulo::class, 'cod_pizzarias');
	}
}
