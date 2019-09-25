<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCepAprovacao
 * 
 * @property int $cod_cep_aprovacao
 * @property int $cep_inicial
 * @property int $cep_final
 * @property string $rua
 * @property string $ponto_referencia
 * @property string $condominio
 * @property string $bairro
 * @property string $regiao
 * @property string $cidade
 * @property string $estado
 * @property string $complemento
 *
 * @package App\Models
 */
class IpiCepAprovacao extends Eloquent
{
	protected $table = 'ipi_cep_aprovacao';
	protected $primaryKey = 'cod_cep_aprovacao';
	public $timestamps = false;

	protected $casts = [
		'cep_inicial' => 'int',
		'cep_final' => 'int'
	];

	protected $fillable = [
		'cep_inicial',
		'cep_final',
		'rua',
		'ponto_referencia',
		'condominio',
		'bairro',
		'regiao',
		'cidade',
		'estado',
		'complemento'
	];
}
