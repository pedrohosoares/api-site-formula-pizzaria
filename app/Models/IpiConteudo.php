<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiConteudo
 * 
 * @property int $cod_conteudos
 * @property string $conteudo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_bebidas
 *
 * @package App\Models
 */
class IpiConteudo extends Eloquent
{
	protected $primaryKey = 'cod_conteudos';
	public $timestamps = false;

	protected $fillable = [
		'conteudo'
	];

	public function ipi_bebidas()
	{
		return $this->belongsToMany(\App\Models\IpiBebida::class, 'ipi_bebidas_ipi_conteudos', 'cod_conteudos', 'cod_bebidas')
					->withPivot('cod_bebidas_ipi_conteudos', 'codigo_cliente_bebida', 'quantidade_embalagem', 'situacao', 'foto_pequena', 'foto_grande', 'cod_unidade_padrao', 'ncm', 'cest', 'cfop', 'cst_icms', 'cst_icms_ecf', 'cst_pis_cofins', 'aliq_icms');
	}
}
