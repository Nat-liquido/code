<?php

namespace Liquido\PayIn\Util;

class LiquidoPayInMethod {
    public const PIX = [
        "title" => "Pix",
        "description" => "O pagamento será aprovado na hora.",
        "image" => "Liquido_PayIn::images/pix.png"
    ];
    public const BOLETO = [
        "title" => "Boleto",
        "description" => "O pagamento será aprovado em até 3 dias úteis.",
        "image" => "Liquido_PayIn::images/boleto.png"
    ];
}