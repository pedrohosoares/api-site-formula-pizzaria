<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEstoqueInventario
 * 
 * @property int $cod_inventarios
 * @property int $cod_pizzarias
 * @property int $cod_usuarios_contagem
 * @property \Carbon\Carbon $data_hora_contagem
 * 
 * @property \App\Models\IpiEstoqueContagem $ipi_estoque_contagem
 *
 * @package App\Models
 */
class IpiEstoqueInventario extends Eloquent
{
	protected $table = 'ipi_estoque_inventario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_inventarios' => 'int',
		'cod_pizzarias' => 'int',
		'cod_usuarios_contagem' => 'int'
	];

	protected $dates = [
		'data_hora_contagem'
	];

	protected $fillable = [
		'cod_inventarios',
		'cod_pizzarias',
		'cod_usuarios_contagem',
		'data_hora_contagem'
	];

	public function ipi_estoque_contagem()
	{
		return $this->hasOne(\App\Models\IpiEstoqueContagem::class, 'cod_inventarios', 'cod_inventarios');
	}
}
