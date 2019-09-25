<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoCategoria
 * 
 * @property int $cod_categorias
 * @property string $nome_categoria
 * @property string $emails_associados
 * @property string $status
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_subcategorias
 *
 * @package App\Models
 */
class IpiComunicacaoCategoria extends Eloquent
{
	protected $primaryKey = 'cod_categorias';
	public $timestamps = false;

	protected $fillable = [
		'nome_categoria',
		'emails_associados',
		'status'
	];

	public function ipi_comunicacao_subcategorias()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoSubcategoria::class, 'cod_categorias');
	}
}
