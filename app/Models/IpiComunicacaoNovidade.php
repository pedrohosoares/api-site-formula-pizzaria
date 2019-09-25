<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoNovidade
 * 
 * @property int $cod_novidades
 * @property int $cod_usuarios
 * @property string $titulo_novidade
 * @property string $novidade
 * @property string $destaque
 * @property \Carbon\Carbon $data_novidade
 * @property string $status
 * 
 * @property \App\Models\NucUsuario $nuc_usuario
 * @property \App\Models\IpiComunicacaoNovidadesArquivo $ipi_comunicacao_novidades_arquivo
 *
 * @package App\Models
 */
class IpiComunicacaoNovidade extends Eloquent
{
	protected $primaryKey = 'cod_novidades';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int'
	];

	protected $dates = [
		'data_novidade'
	];

	protected $fillable = [
		'cod_usuarios',
		'titulo_novidade',
		'novidade',
		'destaque',
		'data_novidade',
		'status'
	];

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}

	public function ipi_comunicacao_novidades_arquivo()
	{
		return $this->hasOne(\App\Models\IpiComunicacaoNovidadesArquivo::class, 'cod_novidades');
	}
}
