<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiColaboradore
 * 
 * @property int $cod_colaboradores
 * @property int $cod_tipo_colaboradores
 * @property int $cod_pizzarias
 * @property string $sexo
 * @property \Carbon\Carbon $data_nascimento
 * @property \Carbon\Carbon $data_admissao
 * @property \Carbon\Carbon $data_demissao
 * @property string $nome
 * @property string $email
 * @property string $cpf
 * @property string $rg
 * @property string $estado_civil
 * @property string $escolaridade
 * @property string $tem_filhos
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $telefone_residencial
 * @property string $telefone_recado
 * @property string $celular
 * @property string $contato_emergencia
 * @property string $telefone_emergencia
 * @property float $salario
 * @property float $comissao
 * @property string $agencia
 * @property string $conta_corrente
 * @property string $banco
 * @property string $fumante
 * @property string $bebida_alcoolica
 * @property string $animais_estimacao
 * @property string $observacoes
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiTipoColaboradore $ipi_tipo_colaboradore
 *
 * @package App\Models
 */
class IpiColaboradore extends Eloquent
{
	protected $primaryKey = 'cod_colaboradores';
	public $timestamps = false;

	protected $casts = [
		'cod_tipo_colaboradores' => 'int',
		'cod_pizzarias' => 'int',
		'salario' => 'float',
		'comissao' => 'float'
	];

	protected $dates = [
		'data_nascimento',
		'data_admissao',
		'data_demissao'
	];

	protected $fillable = [
		'cod_tipo_colaboradores',
		'cod_pizzarias',
		'sexo',
		'data_nascimento',
		'data_admissao',
		'data_demissao',
		'nome',
		'email',
		'cpf',
		'rg',
		'estado_civil',
		'escolaridade',
		'tem_filhos',
		'endereco',
		'numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'telefone_residencial',
		'telefone_recado',
		'celular',
		'contato_emergencia',
		'telefone_emergencia',
		'salario',
		'comissao',
		'agencia',
		'conta_corrente',
		'banco',
		'fumante',
		'bebida_alcoolica',
		'animais_estimacao',
		'observacoes',
		'situacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_tipo_colaboradore()
	{
		return $this->belongsTo(\App\Models\IpiTipoColaboradore::class, 'cod_tipo_colaboradores');
	}
}
