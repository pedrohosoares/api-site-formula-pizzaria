<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFormasPg
 * 
 * @property int $cod_formas_pg
 * @property string $forma_pg
 * @property string $imagem_p
 * @property int $imagem_g
 * @property int $cod_bancos
 * @property int $cod_titulos_subcategorias
 * @property float $taxa
 * @property int $prazo
 * @property string $cod_formas_pg_ifood
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_formas_pg_pizzarias
 *
 * @package App\Models
 */
class IpiFormasPg extends Eloquent
{
	protected $table = 'ipi_formas_pg';
	protected $primaryKey = 'cod_formas_pg';
	public $timestamps = false;

	protected $casts = [
		'imagem_g' => 'int',
		'cod_bancos' => 'int',
		'cod_titulos_subcategorias' => 'int',
		'taxa' => 'float',
		'prazo' => 'int'
	];

	protected $fillable = [
		'forma_pg',
		'imagem_p',
		'imagem_g',
		'cod_bancos',
		'cod_titulos_subcategorias',
		'taxa',
		'prazo',
		'cod_formas_pg_ifood'
	];

	public function ipi_formas_pg_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiFormasPgPizzaria::class, 'cod_formas_pg');
	}
}
