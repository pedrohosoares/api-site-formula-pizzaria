<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTamanhosIpiTipoMassa
 * 
 * @property int $cod_tamanhos
 * @property int $cod_tipo_massa
 * @property float $preco
 * @property bool $selecao_padrao_massa
 * 
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiTipoMassa $ipi_tipo_massa
 *
 * @package App\Models
 */
class IpiTamanhosIpiTipoMassa extends Eloquent
{
	protected $table = 'ipi_tamanhos_ipi_tipo_massa';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tamanhos' => 'int',
		'cod_tipo_massa' => 'int',
		'preco' => 'float',
		'selecao_padrao_massa' => 'bool'
	];

	protected $fillable = [
		'preco',
		'selecao_padrao_massa'
	];

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_tipo_massa()
	{
		return $this->belongsTo(\App\Models\IpiTipoMassa::class, 'cod_tipo_massa');
	}
}
