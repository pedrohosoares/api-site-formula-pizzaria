<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTaxaFrete
 * 
 * @property int $cod_taxa_frete
 * @property int $cod_pizzarias
 * @property float $valor_frete
 * @property float $valor_comissao_frete
 * @property string $descricao_taxa
 * @property string $tipo_frete
 *
 * @package App\Models
 */
class IpiTaxaFrete extends Eloquent
{
	protected $table = 'ipi_taxa_frete';
	protected $primaryKey = 'cod_taxa_frete';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'valor_frete' => 'float',
		'valor_comissao_frete' => 'float'
	];

	protected $fillable = [
		'cod_pizzarias',
		'valor_frete',
		'valor_comissao_frete',
		'descricao_taxa',
		'tipo_frete'
	];
}
