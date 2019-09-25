<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiBorda
 * 
 * @property int $cod_bordas
 * @property int $cod_ingredientes
 * @property string $borda
 * @property bool $novidade
 * @property string $foto_pequena
 * @property string $foto_grande
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_bordas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos
 *
 * @package App\Models
 */
class IpiBorda extends Eloquent
{
	protected $primaryKey = 'cod_bordas';
	public $timestamps = false;

	protected $casts = [
		'cod_ingredientes' => 'int',
		'novidade' => 'bool'
	];

	protected $fillable = [
		'cod_ingredientes',
		'borda',
		'novidade',
		'foto_pequena',
		'foto_grande'
	];

	public function ipi_pedidos_bordas()
	{
		return $this->hasMany(\App\Models\IpiPedidosBorda::class, 'cod_bordas');
	}

	public function ipi_tamanhos()
	{
		return $this->belongsToMany(\App\Models\IpiTamanho::class, 'ipi_tamanhos_ipi_bordas', 'cod_bordas', 'cod_tamanhos')
					->withPivot('cod_pizzarias', 'preco', 'valor_imposto', 'pontos_fidelidade', 'selecao_padrao_borda');
	}
}
