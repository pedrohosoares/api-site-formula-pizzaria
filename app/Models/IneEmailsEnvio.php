<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IneEmailsEnvio
 * 
 * @property int $cod_emails_envio
 * @property string $email
 * @property string $nome
 * @property bool $ativo
 * @property string $login
 * @property string $smtp
 * @property int $porta_smtp
 * @property string $senha
 * @property int $numero_envios
 *
 * @package App\Models
 */
class IneEmailsEnvio extends Eloquent
{
	protected $table = 'ine_emails_envio';
	protected $primaryKey = 'cod_emails_envio';
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'bool',
		'porta_smtp' => 'int',
		'numero_envios' => 'int'
	];

	protected $fillable = [
		'email',
		'nome',
		'ativo',
		'login',
		'smtp',
		'porta_smtp',
		'senha',
		'numero_envios'
	];
}
