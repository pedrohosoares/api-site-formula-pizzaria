<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IcoCamposModelo
 * 
 * @property int $cod_campos_modelos
 * @property int $cod_modelos
 * @property int $cod_tipos_campos
 * @property int $quantidade
 * 
 * @property \App\Models\IcoModelo $ico_modelo
 * @property \App\Models\IcoTiposCampo $ico_tipos_campo
 *
 * @package App\Models
 */
class IcoCamposModelo extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_modelos' => 'int',
		'cod_tipos_campos' => 'int',
		'quantidade' => 'int'
	];

	protected $fillable = [
		'quantidade'
	];

	public function ico_modelo()
	{
		return $this->belongsTo(\App\Models\IcoModelo::class, 'cod_modelos');
	}

	public function ico_tipos_campo()
	{
		return $this->belongsTo(\App\Models\IcoTiposCampo::class, 'cod_tipos_campos');
	}
}
