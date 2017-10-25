<?php

function cpf_chk($cpf)
{
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://consultarcpf.gratis/mobile/re.php?cpf=" . $cpf . "&consultar=OK");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $dados = curl_exec($ch);
    curl_close($ch);
    
    preg_match_all("(NOME: <strong> <strong>(.*)</td>)siU", $dados, $match1);
    preg_match_all("(NASCIMENTO: <strong> <strong>(.*)</td>)siU", $dados, $match2);
    
    if (!empty($match1[1][0])) {
        
        $nome   = trim($match1[1][0]);
        $dtnasc = trim($match2[1][0]);
        
        return "*CPF:* `$cpf`\n*Nome:* `$nome`\n*Dt. Nasc:* `$dtnasc`";
        
    } else {
        return "*CPF inválido!*";
    }
}