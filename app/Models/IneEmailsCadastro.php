<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IneEmailsCadastro
 * 
 * @property int $cod_emails_cadastro
 * @property string $email
 * @property int $ativo
 * @property int $recebimentos
 * @property \Carbon\Carbon $ultimo_recebimento
 * @property int $cod_ligacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ine_mensagens
 *
 * @package App\Models
 */
class IneEmailsCadastro extends Eloquent
{
	protected $table = 'ine_emails_cadastro';
	protected $primaryKey = 'cod_emails_cadastro';
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int',
		'recebimentos' => 'int',
		'cod_ligacao' => 'int'
	];

	protected $dates = [
		'ultimo_recebimento'
	];

	protected $fillable = [
		'email',
		'ativo',
		'recebimentos',
		'ultimo_recebimento',
		'cod_ligacao'
	];

	public function ine_mensagens()
	{
		return $this->belongsToMany(\App\Models\IneMensagen::class, 'ine_emails_cadastro_ine_mensagens', 'cod_emails_cadastro', 'cod_mensagens')
					->withPivot('agendamento', 'situacao');
	}
}
