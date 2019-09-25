<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiBanco
 * 
 * @property int $cod_bancos
 * @property string $banco
 * @property string $agencia
 * @property string $conta_corrente
 * @property float $saldo_atual
 * @property bool $caixa
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzarias
 *
 * @package App\Models
 */
class IpiBanco extends Eloquent
{
	protected $primaryKey = 'cod_bancos';
	public $timestamps = false;

	protected $casts = [
		'saldo_atual' => 'float',
		'caixa' => 'bool'
	];

	protected $fillable = [
		'banco',
		'agencia',
		'conta_corrente',
		'saldo_atual',
		'caixa',
		'situacao'
	];

	public function ipi_pizzarias()
	{
		return $this->belongsToMany(\App\Models\IpiPizzaria::class, 'ipi_bancos_ipi_pizzarias', 'cod_bancos', 'cod_pizzarias')
					->withPivot('cod_bancos_pizzarias');
	}
}
