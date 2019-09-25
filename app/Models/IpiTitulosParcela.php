<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTitulosParcela
 * 
 * @property int $cod_titulos_parcelas
 * @property int $cod_bancos_origem
 * @property int $cod_bancos_destino
 * @property int $cod_titulos
 * @property int $cod_formas_pg
 * @property \Carbon\Carbon $data_vencimento
 * @property \Carbon\Carbon $data_pagamento
 * @property \Carbon\Carbon $data_emissao
 * @property \Carbon\Carbon $data_hora_criacao
 * @property float $valor
 * @property float $juros
 * @property float $valor_total
 * @property int $numero_parcela
 * @property string $forma_pagamento
 * @property string $cheque_numero
 * @property string $cheque_favorecido
 * @property string $documento_numero
 * @property string $obs
 * @property bool $recebido_enviado
 * @property int $mes_ref
 * @property int $ano_ref
 * @property string $situacao
 * @property int $cod_usuarios_estorno
 * @property \Carbon\Carbon $data_hora_estorno
 * 
 * @property \App\Models\IpiTitulo $ipi_titulo
 *
 * @package App\Models
 */
class IpiTitulosParcela extends Eloquent
{
	protected $primaryKey = 'cod_titulos_parcelas';
	public $timestamps = false;

	protected $casts = [
		'cod_bancos_origem' => 'int',
		'cod_bancos_destino' => 'int',
		'cod_titulos' => 'int',
		'cod_formas_pg' => 'int',
		'valor' => 'float',
		'juros' => 'float',
		'valor_total' => 'float',
		'numero_parcela' => 'int',
		'recebido_enviado' => 'bool',
		'mes_ref' => 'int',
		'ano_ref' => 'int',
		'cod_usuarios_estorno' => 'int'
	];

	protected $dates = [
		'data_vencimento',
		'data_pagamento',
		'data_emissao',
		'data_hora_criacao',
		'data_hora_estorno'
	];

	protected $fillable = [
		'cod_bancos_origem',
		'cod_bancos_destino',
		'cod_titulos',
		'cod_formas_pg',
		'data_vencimento',
		'data_pagamento',
		'data_emissao',
		'data_hora_criacao',
		'valor',
		'juros',
		'valor_total',
		'numero_parcela',
		'forma_pagamento',
		'cheque_numero',
		'cheque_favorecido',
		'documento_numero',
		'obs',
		'recebido_enviado',
		'mes_ref',
		'ano_ref',
		'situacao',
		'cod_usuarios_estorno',
		'data_hora_estorno'
	];

	public function ipi_titulo()
	{
		return $this->belongsTo(\App\Models\IpiTitulo::class, 'cod_titulos');
	}
}
