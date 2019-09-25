<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFranqueado
 * 
 * @property int $cod_franqueados
 * @property int $cod_pizzarias
 * @property string $sexo
 * @property \Carbon\Carbon $data_nascimento
 * @property string $nome
 * @property string $email
 * @property string $cpf
 * @property string $rg
 * @property string $estado_civil
 * @property string $escolaridade
 * @property string $profissao
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
 * @property string $id_nextel
 * @property string $fumante
 * @property string $bebida_alcoolica
 * @property string $animais_estimacao
 * @property string $observacoes
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiFranqueado extends Eloquent
{
	protected $primaryKey = 'cod_franqueados';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int'
	];

	protected $dates = [
		'data_nascimento'
	];

	protected $fillable = [
		'cod_pizzarias',
		'sexo',
		'data_nascimento',
		'nome',
		'email',
		'cpf',
		'rg',
		'estado_civil',
		'escolaridade',
		'profissao',
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
		'id_nextel',
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
}
