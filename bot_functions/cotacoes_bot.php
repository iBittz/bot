<?php
function cotacoes()
{
    
    $get_dolar = file_get_contents('http://dolarhoje.com');
    $get_euro  = file_get_contents('http://dolarhoje.com/euro');
    $get_libra = file_get_contents('http://dolarhoje.com/libra-hoje');
    $get_ouro  = file_get_contents('http://dolarhoje.com/ouro-hoje');
    $get_peso1 = file_get_contents('http://dolarhoje.com/peso-argentino');
    $get_iene  = file_get_contents('http://dolarhoje.com/iene');
    
    
    preg_match_all('(<input type="text" id="nacional" value="(.*)"/>)siU', $get_dolar, $match0);
    preg_match_all('(<input type="text" id="nacional" value="(.*)"/>)siU', $get_euro, $match1);
    preg_match_all('(<input type="text" id="nacional" value="(.*)"/>)siU', $get_libra, $match2);
    preg_match_all('(<input type="text" id="nacional" value="(.*)"/>)siU', $get_ouro, $match3);
    preg_match_all('(<input type="text" id="nacional" value="(.*)"/>)siU', $get_peso1, $match4);
    preg_match_all('(<input type="text" id="estrangeiro" value="(.*)"/>)siU', $get_iene, $match5);
    
    $dolar   = $match0[1][0];
    $euro    = $match1[1][0];
    $libra   = $match2[1][0];
    $ouro    = $match3[1][0];
    $peso_ar = $match4[1][0];
    $ienes   = $match5[1][0];
    
    return "*Cotações de Moedas:*\n*Hoje:* `" . data_e_hora() . "`\n\n*Dólar:* `R$$dolar`\n*Euro:* `R$$euro`\n*Libra:* `R$$libra`\n*Ouro:* `R$$ouro`\n*Peso Argentino:* `R$$peso_ar`\n*Iene:* `R$1,00 = ¥$ienes`\n\n*Atualizado em Tempo real.*";
}

function criptomoedas()
{
    
    $get_btc   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=BRL"));
    $get_bch   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/bitcoin-cash/?convert=BRL"));
    $get_eth   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=BRL"));
    $get_etc   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/ethereum-classic/?convert=BRL"));
    $get_ltc   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/litecoin/?convert=BRL"));
    $get_dash  = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/dash/?convert=BRL"));
    $get_xmr   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/monero/?convert=BRL"));
    $get_xrp   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/ripple/?convert=BRL"));
    $get_zec   = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/zcash/?convert=BRL"));
    $get_steem = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/steem/?convert=BRL"));
    
    
    $btc   = number_format($get_btc[0]->{"price_brl"}, 2);
    $bch   = number_format($get_bch[0]->{"price_brl"}, 2);
    $eth   = number_format($get_eth[0]->{"price_brl"}, 2);
    $etc   = number_format($get_etc[0]->{"price_brl"}, 2);
    $ltc   = number_format($get_ltc[0]->{"price_brl"}, 2);
    $dash  = number_format($get_dash[0]->{"price_brl"}, 2);
    $xmr   = number_format($get_xmr[0]->{"price_brl"}, 2);
    $xrp   = number_format($get_xrp[0]->{"price_brl"}, 2);
    $zec   = number_format($get_zec[0]->{"price_brl"}, 2);
    $steem = number_format($get_steem[0]->{"price_brl"}, 2);
    
    return "*Cota de Criptomoedas:*\n*Hoje:* `" . data_e_hora() . "`\n\n*Bitcoin:* `R$$btc`\n*Bitcoin Cash:* `R$$bch`\n*Ethereum:* `R$$eth`\n*Ethereum Classic:* `R$$etc`\n*Litecoin:* `R$$ltc`\n*Monero:* `R$$xmr`\n*Dash:* `R$$dash`\n*Ripple:* `R$$xrp`\n*Zcash:* `R$$zec`\n*Steem:* `R$$steem`\n\n*Atualizado em tempo real.*";
}

function data_e_hora()
{
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $data = strftime('%d/%m/%Y %H:%M:%S', strtotime('now'));
    return $data;
} 