<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiOpcoesCorte
 * 
 * @property int $cod_opcoes_corte
 * @property string $opcao_corte
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_tamanhos
 *
 * @package App\Models
 */
class IpiOpcoesCorte extends Eloquent
{
	protected $table = 'ipi_opcoes_corte';
	protected $primaryKey = 'cod_opcoes_corte';
	public $timestamps = false;

	protected $fillable = [
		'opcao_corte'
	];

	public function ipi_tamanhos()
	{
		return $this->belongsToMany(\App\Models\IpiTamanho::class, 'ipi_tamanhos_ipi_opcoes_corte', 'cod_opcoes_corte', 'cod_tamanhos')
					->withPivot('preco', 'tamanho_padrao', 'selecao_padrao_corte');
	}

	public function getOpcoesCorte($cod_opcoes_corte){
		return $this->where('cod_opcoes_corte',$cod_opcoes_corte);
	}
}
