<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCep
 * 
 * @property int $cod_cep
 * @property int $cod_pizzarias
 * @property int $cep_inicial
 * @property int $cep_final
 * @property string $bairro
 * @property string $rua
 * @property string $ponto_referencia
 * @property string $condominio
 * @property string $regiao
 * @property int $distancia
 * @property int $cod_taxa_frete
 * @property int $cod_pedido_minimo
 * @property string $cidade
 * @property string $estado
 * @property string $complemento
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiCep extends Eloquent
{
	protected $table = 'ipi_cep';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cep_inicial' => 'int',
		'cep_final' => 'int',
		'distancia' => 'int',
		'cod_taxa_frete' => 'int',
		'cod_pedido_minimo' => 'int'
	];

	protected $fillable = [
		'cep_inicial',
		'cep_final',
		'bairro',
		'rua',
		'ponto_referencia',
		'condominio',
		'regiao',
		'distancia',
		'cod_taxa_frete',
		'cod_pedido_minimo',
		'cidade',
		'estado',
		'complemento'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
