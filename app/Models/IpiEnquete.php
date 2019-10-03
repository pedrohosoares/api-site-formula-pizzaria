<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEnquete
 * 
 * @property int $cod_enquetes
 * @property string $enquete
 * @property string $situacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_enquete_perguntas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos
 *
 * @package App\Models
 */
class IpiEnquete extends Eloquent
{
	protected $primaryKey = 'cod_enquetes';
	public $timestamps = false;

	protected $fillable = [
		'enquete',
		'situacao'
	];

	public function ipi_enquete_perguntas()
	{
		return $this->hasMany(\App\Models\IpiEnquetePergunta::class, 'cod_enquetes','cod_enquetes');
	}

	public function ipi_pedidos()
	{
		return $this->belongsToMany(\App\Models\IpiPedido::class, 'ipi_pedidos_ipi_enquetes', 'cod_enquetes', 'cod_pedidos')
					->withPivot('data_hora_gravacao');
	}
}
