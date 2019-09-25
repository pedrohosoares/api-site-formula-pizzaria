<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFaleConosco
 * 
 * @property int $cod_fale_conosco
 * @property int $cod_clientes
 * @property int $cod_usuarios
 * @property string $cod_pizzarias
 * @property string $pergunta_fale_conosco
 * @property string $resposta_fale_conosco
 * @property bool $respondida
 * @property bool $respondida_tel
 * @property \Carbon\Carbon $data_hora_reposta
 * @property \Carbon\Carbon $data_hora_fale_conosco
 * @property string $nome
 * @property string $telefone
 * @property string $email
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_fale_conosco_categorias_comentarios
 *
 * @package App\Models
 */
class IpiFaleConosco extends Eloquent
{
	protected $table = 'ipi_fale_conosco';
	protected $primaryKey = 'cod_fale_conosco';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_usuarios' => 'int',
		'respondida' => 'bool',
		'respondida_tel' => 'bool'
	];

	protected $dates = [
		'data_hora_reposta',
		'data_hora_fale_conosco'
	];

	protected $fillable = [
		'cod_clientes',
		'cod_usuarios',
		'cod_pizzarias',
		'pergunta_fale_conosco',
		'resposta_fale_conosco',
		'respondida',
		'respondida_tel',
		'data_hora_reposta',
		'data_hora_fale_conosco',
		'nome',
		'telefone',
		'email'
	];

	public function ipi_fale_conosco_categorias_comentarios()
	{
		return $this->hasMany(\App\Models\IpiFaleConoscoCategoriasComentario::class, 'cod_fale_conosco');
	}
}
