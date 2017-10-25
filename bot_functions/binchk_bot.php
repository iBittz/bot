<?php

function BIN_Chk($bin_chk)
{
    GLOBAL $dev_link;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://validate.creditcard/iin-bin/number-lookup/" . $bin_chk . "?bin=1");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $dados = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($dados, "Success!") !== false) {
        
        preg_match_all("(Card Brand</div><div class=\"bottom-block__content-list\">(.*)</div>)siU", $dados, $matcher1);
        preg_match_all("(Card Type</div><div class=\"bottom-block__content-list\">(.*)</div>)siU", $dados, $matcher2);
        preg_match_all("(Card Category</div><div class=\"bottom-block__content-list\">(.*)</div>)siU", $dados, $matcher3);
        preg_match_all("(Card Country</div><div class=\"bottom-block__content-list\">(.*)</div>)siU", $dados, $matcher4);
        preg_match_all("(Issuer Bank Name</div><div class=\"bottom-block__content-list\">(.*)</div>)siU", $dados, $matcher5);
        preg_match_all("(Issuer Bank Phone Number</div><div class=\"bottom-block__content-list\">(.*)</div>)siU", $dados, $matcher6);
        preg_match_all("(Issuer Bank Website</div><div class=\"bottom-block__content-list\"><a rel=\"nofollow\" href=\"(.*)\">)siU", $dados, $matcher7);
        
        $bincode = $bin_chk;
        $brand   = $matcher1[1][0];
        $type    = $matcher2[1][0] == "" ? "N/A" : $matcher2[1][0];
        $level   = $matcher3[1][0] == "" ? "N/A" : $matcher3[1][0];
        $bank    = $matcher5[1][0] == "" ? "N/A" : $matcher5[1][0];
        $country = $matcher4[1][0] == "" ? "N/A" : $matcher4[1][0];
        $bphone  = $matcher6[1][0] == "" ? "N/A" : $matcher6[1][0];
        $bsite   = $matcher7[1][0] == "" ? "N/A" : $matcher7[1][0];
        
        return "*IIN/BIN:* `$bincode`\n*Bandeira:* `$brand`\n*Tipo:* `$type`\n*Nível:* `$level`\n*Banco:* [$bank]($bsite)\n*País:* `$country`\n*Tel:* `$bphone`";
        
    } elseif (strpos($dados, "Invalid IIN/BIN Number!") !== false) {
        return "*BIN inválida!*";
    } else {
        return "*ERRO DESCONHECIDO, use o comando novamente! Se o problema pessistir, notifique meu* [desenvolvedor.]($dev_link)";
    }
}