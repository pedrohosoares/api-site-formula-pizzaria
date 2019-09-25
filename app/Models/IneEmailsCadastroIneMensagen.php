<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IneEmailsCadastroIneMensagen
 * 
 * @property int $cod_emails_cadastro
 * @property int $cod_mensagens
 * @property \Carbon\Carbon $agendamento
 * @property string $situacao
 * 
 * @property \App\Models\IneEmailsCadastro $ine_emails_cadastro
 * @property \App\Models\IneMensagen $ine_mensagen
 *
 * @package App\Models
 */
class IneEmailsCadastroIneMensagen extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_emails_cadastro' => 'int',
		'cod_mensagens' => 'int'
	];

	protected $dates = [
		'agendamento'
	];

	protected $fillable = [
		'situacao'
	];

	public function ine_emails_cadastro()
	{
		return $this->belongsTo(\App\Models\IneEmailsCadastro::class, 'cod_emails_cadastro');
	}

	public function ine_mensagen()
	{
		return $this->belongsTo(\App\Models\IneMensagen::class, 'cod_mensagens');
	}
}
