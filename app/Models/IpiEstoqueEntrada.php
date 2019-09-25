<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEstoqueEntrada
 * 
 * @property int $cod_estoque_entrada
 * @property int $cod_fornecedores
 * @property int $cod_usuarios
 * @property int $cod_pizzarias
 * @property \Carbon\Carbon $data_hota_entrada_estoque
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\NucUsuario $nuc_usuario
 * @property \App\Models\IpiFornecedore $ipi_fornecedore
 * @property \Illuminate\Database\Eloquent\Collection $ipi_estoque_entrada_itens
 *
 * @package App\Models
 */
class IpiEstoqueEntrada extends Eloquent
{
	protected $table = 'ipi_estoque_entrada';
	protected $primaryKey = 'cod_estoque_entrada';
	public $timestamps = false;

	protected $casts = [
		'cod_fornecedores' => 'int',
		'cod_usuarios' => 'int',
		'cod_pizzarias' => 'int'
	];

	protected $dates = [
		'data_hota_entrada_estoque'
	];

	protected $fillable = [
		'cod_fornecedores',
		'cod_usuarios',
		'cod_pizzarias',
		'data_hota_entrada_estoque'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}

	public function ipi_fornecedore()
	{
		return $this->belongsTo(\App\Models\IpiFornecedore::class, 'cod_fornecedores');
	}

	public function ipi_estoque_entrada_itens()
	{
		return $this->hasMany(\App\Models\IpiEstoqueEntradaIten::class, 'cod_estoque_entrada');
	}
}
