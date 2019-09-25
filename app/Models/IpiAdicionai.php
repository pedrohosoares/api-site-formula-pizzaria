<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiAdicionai
 * 
 * @property int $cod_adicionais
 * @property string $adicional
 * @property int $cod_ingredientes
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_adicionais
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos
 *
 * @package App\Models
 */
class IpiAdicionai extends Eloquent
{
	protected $primaryKey = 'cod_adicionais';
	public $timestamps = false;

	protected $casts = [
		'cod_ingredientes' => 'int'
	];

	protected $fillable = [
		'adicional',
		'cod_ingredientes'
	];

	public function ipi_pedidos_adicionais()
	{
		return $this->hasMany(\App\Models\IpiPedidosAdicionai::class, 'cod_adicionais');
	}

	public function ipi_tamanhos()
	{
		return $this->belongsToMany(\App\Models\IpiTamanho::class, 'ipi_tamanhos_ipi_adicionais', 'cod_adicionais', 'cod_tamanhos')
					->withPivot('cod_pizzarias', 'preco', 'selecao_padrao_adicional', 'valor_imposto');
	}
}
