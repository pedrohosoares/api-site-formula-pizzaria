<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTipoMassa
 * 
 * @property int $cod_tipo_massa
 * @property string $tipo_massa
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos
 *
 * @package App\Models
 */
class IpiTipoMassa extends Eloquent
{
	protected $table = 'ipi_tipo_massa';
	protected $primaryKey = 'cod_tipo_massa';
	public $timestamps = false;

	protected $fillable = [
		'tipo_massa'
	];

	public function ipi_tamanhos()
	{
		return $this->belongsToMany(\App\Models\IpiTamanho::class, 'ipi_tamanhos_ipi_tipo_massa', 'cod_tipo_massa', 'cod_tamanhos')
					->withPivot('preco', 'selecao_padrao_massa');
	}
	public function getTipoMassa($cod_tipo_massa){
		return $this->where('cod_tipo_massa',$cod_tipo_massa);
	}
}
