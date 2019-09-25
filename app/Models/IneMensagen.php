<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IneMensagen
 * 
 * @property int $cod_mensagens
 * @property int $cod_imagens_mensagem
 * @property int $cod_imagens_rodape
 * @property int $cod_imagens_cabecalho
 * @property bool $mensagem_avancada
 * @property string $assunto
 * @property string $mensagem
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ine_emails_cadastros
 *
 * @package App\Models
 */
class IneMensagen extends Eloquent
{
	protected $primaryKey = 'cod_mensagens';
	public $timestamps = false;

	protected $casts = [
		'cod_imagens_mensagem' => 'int',
		'cod_imagens_rodape' => 'int',
		'cod_imagens_cabecalho' => 'int',
		'mensagem_avancada' => 'bool'
	];

	protected $fillable = [
		'cod_imagens_mensagem',
		'cod_imagens_rodape',
		'cod_imagens_cabecalho',
		'mensagem_avancada',
		'assunto',
		'mensagem'
	];

	public function ine_emails_cadastros()
	{
		return $this->belongsToMany(\App\Models\IneEmailsCadastro::class, 'ine_emails_cadastro_ine_mensagens', 'cod_mensagens', 'cod_emails_cadastro')
					->withPivot('agendamento', 'situacao');
	}
}
