<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEntregadore
 * 
 * @property int $cod_entregadores
 * @property int $cod_pizzarias
 * @property string $nome
 * @property string $numero_cadastro
 * @property string $sexo
 * @property \Carbon\Carbon $data_nascimento
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
 * @property string $balcao
 * @property string $fumante
 * @property string $bebida_alcoolica
 * @property string $animais_estimacao
 * @property string $moto_modelo
 * @property string $moto_marca
 * @property string $moto_placa
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_entregas_avulsas
 *
 * @package App\Models
 */
class IpiEntregadore extends Eloquent
{
	protected $primaryKey = 'cod_entregadores';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int'
	];

	protected $dates = [
		'data_nascimento'
	];

	protected $fillable = [
		'cod_pizzarias',
		'nome',
		'numero_cadastro',
		'sexo',
		'data_nascimento',
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
		'balcao',
		'fumante',
		'bebida_alcoolica',
		'animais_estimacao',
		'moto_modelo',
		'moto_marca',
		'moto_placa',
		'situacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_entregas_avulsas()
	{
		return $this->hasMany(\App\Models\IpiEntregasAvulsa::class, 'cod_entregadores');
	}
}
