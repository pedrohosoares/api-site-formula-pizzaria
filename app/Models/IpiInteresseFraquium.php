<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiInteresseFraquium
 * 
 * @property int $cod_interesse_fraquia
 * @property \Carbon\Carbon $data_cadastro
 * @property string $nome
 * @property string $sexo
 * @property \Carbon\Carbon $data_nascimento
 * @property string $estado_civil
 * @property int $tem_filhos
 * @property string $idades
 * @property string $cep
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $telefone
 * @property string $telefone_comercial
 * @property string $celular
 * @property string $email
 * @property string $escolaridade
 * @property string $profissao
 * @property string $profissao_conjugue
 * @property string $negocio_proprio
 * @property string $qual_negocio
 * @property \Carbon\Carbon $data_inicio_negocio
 * @property \Carbon\Carbon $data_saida_negocio
 * @property string $interesses
 * @property string $papel_sociedade
 * @property string $tempo_dedicacao
 * @property string $regiao_interesse
 * @property int $investimento
 * @property string $comentarios
 * @property string $como_conheceu
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_interesse_comentarios
 *
 * @package App\Models
 */
class IpiInteresseFraquium extends Eloquent
{
	protected $primaryKey = 'cod_interesse_fraquia';
	public $timestamps = false;

	protected $casts = [
		'tem_filhos' => 'int',
		'investimento' => 'int'
	];

	protected $dates = [
		'data_cadastro',
		'data_nascimento',
		'data_inicio_negocio',
		'data_saida_negocio'
	];

	protected $fillable = [
		'data_cadastro',
		'nome',
		'sexo',
		'data_nascimento',
		'estado_civil',
		'tem_filhos',
		'idades',
		'cep',
		'endereco',
		'numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'telefone',
		'telefone_comercial',
		'celular',
		'email',
		'escolaridade',
		'profissao',
		'profissao_conjugue',
		'negocio_proprio',
		'qual_negocio',
		'data_inicio_negocio',
		'data_saida_negocio',
		'interesses',
		'papel_sociedade',
		'tempo_dedicacao',
		'regiao_interesse',
		'investimento',
		'comentarios',
		'como_conheceu',
		'situacao'
	];

	public function ipi_interesse_comentarios()
	{
		return $this->hasMany(\App\Models\IpiInteresseComentario::class, 'cod_interesse_fraquia');
	}
}
