<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiBebida
 * 
 * @property int $cod_bebidas
 * @property int $cod_tipo_bebida
 * @property string $bebida
 * @property int $ncm
 * @property string $cest
 * @property int $cst_icms
 * @property string $cst_icms_ecf
 * @property int $cst_pis_cofins
 * @property float $aliq_icms
 * @property string $cod_barras
 * @property int $id_icms_ecf
 * @property int $id_pis_cofins_ecf
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_conteudos
 *
 * @package App\Models
 */
class IpiBebida extends Eloquent
{
	protected $primaryKey = 'cod_bebidas';
	public $timestamps = false;

	protected $casts = [
		'cod_tipo_bebida' => 'int',
		'ncm' => 'int',
		'cst_icms' => 'int',
		'cst_pis_cofins' => 'int',
		'aliq_icms' => 'float',
		'id_icms_ecf' => 'int',
		'id_pis_cofins_ecf' => 'int'
	];

	protected $fillable = [
		'cod_tipo_bebida',
		'bebida',
		'ncm',
		'cest',
		'cst_icms',
		'cst_icms_ecf',
		'cst_pis_cofins',
		'aliq_icms',
		'cod_barras',
		'id_icms_ecf',
		'id_pis_cofins_ecf'
	];

	public function ipi_conteudos()
	{
		return $this->belongsToMany(\App\Models\IpiConteudo::class, 'ipi_bebidas_ipi_conteudos', 'cod_bebidas', 'cod_conteudos')
					->withPivot('cod_bebidas_ipi_conteudos', 'codigo_cliente_bebida', 'quantidade_embalagem', 'situacao', 'foto_pequena', 'foto_grande', 'cod_unidade_padrao', 'ncm', 'cest', 'cfop', 'cst_icms', 'cst_icms_ecf', 'cst_pis_cofins', 'aliq_icms');
	}
}
