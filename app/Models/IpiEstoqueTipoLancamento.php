<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEstoqueTipoLancamento
 * 
 * @property int $cod_estoque_tipo_lancamento
 * @property string $estoque_tipo_lancamento
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_estoques
 *
 * @package App\Models
 */
class IpiEstoqueTipoLancamento extends Eloquent
{
	protected $table = 'ipi_estoque_tipo_lancamento';
	protected $primaryKey = 'cod_estoque_tipo_lancamento';
	public $timestamps = false;

	protected $fillable = [
		'estoque_tipo_lancamento'
	];

	public function ipi_estoques()
	{
		return $this->hasMany(\App\Models\IpiEstoque::class, 'cod_estoque_tipo_lancamento');
	}
}
