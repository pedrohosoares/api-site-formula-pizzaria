<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCodigosProduto
 * 
 * @property int $cod_codigos_produtos
 * @property string $tabela
 * @property string $coluna
 * @property int $foreignkey
 * @property int $ncm
 * @property int $cest
 * @property string $cfop
 * @property int $cst_icms
 * @property string $cst_icms_ecf
 * @property int $cst_pis_cofins
 * @property float $aliq_icms
 *
 * @package App\Models
 */
class IpiCodigosProduto extends Eloquent
{
	protected $primaryKey = 'cod_codigos_produtos';
	public $timestamps = false;

	protected $casts = [
		'foreignkey' => 'int',
		'ncm' => 'int',
		'cest' => 'int',
		'cst_icms' => 'int',
		'cst_pis_cofins' => 'int',
		'aliq_icms' => 'float'
	];

	protected $fillable = [
		'tabela',
		'coluna',
		'foreignkey',
		'ncm',
		'cest',
		'cfop',
		'cst_icms',
		'cst_icms_ecf',
		'cst_pis_cofins',
		'aliq_icms'
	];
}
