<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTelemarketingAtivo
 * 
 * @property int $cod_telemarketing_ativo
 * @property int $cod_usuarios
 * @property int $cod_pizzarias
 * @property string $mensagem
 * @property \Carbon\Carbon $data_hora_telemarketing
 * @property \Carbon\Carbon $data_inicial_prog
 * @property \Carbon\Carbon $data_final_prog
 * @property bool $mensagem_obrigatoria
 * @property string $situacao
 * 
 * @property \App\Models\NucUsuario $nuc_usuario
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \Illuminate\Database\Eloquent\Collection $ipi_telemarketing_ativo_respostas
 *
 * @package App\Models
 */
class IpiTelemarketingAtivo extends Eloquent
{
	protected $table = 'ipi_telemarketing_ativo';
	protected $primaryKey = 'cod_telemarketing_ativo';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int',
		'cod_pizzarias' => 'int',
		'mensagem_obrigatoria' => 'bool'
	];

	protected $dates = [
		'data_hora_telemarketing',
		'data_inicial_prog',
		'data_final_prog'
	];

	protected $fillable = [
		'cod_usuarios',
		'cod_pizzarias',
		'mensagem',
		'data_hora_telemarketing',
		'data_inicial_prog',
		'data_final_prog',
		'mensagem_obrigatoria',
		'situacao'
	];

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_telemarketing_ativo_respostas()
	{
		return $this->hasMany(\App\Models\IpiTelemarketingAtivoResposta::class, 'cod_telemarketing_ativo');
	}
}
