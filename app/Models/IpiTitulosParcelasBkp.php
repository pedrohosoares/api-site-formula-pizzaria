<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTitulosParcelasBkp
 * 
 * @property int $cod_titulos_parcelas
 * @property int $cod_bancos_origem
 * @property int $cod_bancos_destino
 * @property int $cod_titulos
 * @property \Carbon\Carbon $data_vencimento
 * @property \Carbon\Carbon $data_pagamento
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
 *
 * @package App\Models
 */
class IpiTitulosParcelasBkp extends Eloquent
{
	protected $table = 'ipi_titulos_parcelas_bkp';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_titulos_parcelas' => 'int',
		'cod_bancos_origem' => 'int',
		'cod_bancos_destino' => 'int',
		'cod_titulos' => 'int',
		'valor' => 'float',
		'juros' => 'float',
		'valor_total' => 'float',
		'numero_parcela' => 'int',
		'recebido_enviado' => 'bool',
		'mes_ref' => 'int',
		'ano_ref' => 'int'
	];

	protected $dates = [
		'data_vencimento',
		'data_pagamento'
	];

	protected $fillable = [
		'cod_titulos_parcelas',
		'cod_bancos_origem',
		'cod_bancos_destino',
		'cod_titulos',
		'data_vencimento',
		'data_pagamento',
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
		'situacao'
	];
}
