<?php

$cookies = dirname(__FILE__) . "/tcpvpn_cookies.txt";

function tcpvpn($country)
{
    if (file_exists($GLOBALS["cookies"])) {
        unlink($GLOBALS["cookies"]); // deletar arquivo cookie
    }
    
    GLOBAL $dev_link;
    
    if ($country == "us") { // united states
        $server = 61;
    }
    if ($country == "ca") { // canada
        $server = 85;
    }
    if ($country == "uk") { // united kingdom
        $server = 8;
    }
    if ($country == "sg") { // singapore
        $server = 139;
    }
    if ($country == "fr") { // france
        $server = 136;
    }
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.tcpvpn.com");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_REFERER, "https://www.tcpvpn.com");
    curl_setopt($ch, CURLOPT_COOKIEJAR, $GLOBALS["cookies"]);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $GLOBALS["cookies"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $request = curl_exec($ch);
    
    curl_setopt($ch, CURLOPT_URL, "https://www.tcpvpn.com/create-vpn-account-america");
    curl_setopt($ch, CURLOPT_COOKIEJAR, $GLOBALS["cookies"]);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $GLOBALS["cookies"]);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0");
    curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        "serverid" => $server,
        "username" => gerar_username(),
        "password" => gerar_password(),
        "create" => ""
    )));
    $dados = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($dados, "Account has been successfully created") !== false) {
        
        preg_match_all("(<strong>Username : <span id='copyTarget'>(.*)</span>)siU", $dados, $match1);
        preg_match_all("(<br>Password : <span id='copyTarget2'>(.*)</span>)siU", $dados, $match2);
        preg_match_all("(<br>IP : <strong>(.*)</strong>)siU", $dados, $match3);
        preg_match_all("(<br>Host : <strong>(.*)</strong>)siU", $dados, $match4);
        preg_match_all("(<br>Date Created : (.*)<br>Account will expire on (.*).<br></div>)siU", $dados, $match5);
        
        $username = trim($match1[1][0]);
        $password = trim($match2[1][0]);
        $ip       = trim($match3[1][0]);
        $host     = trim($match4[1][0]);
        $created  = trim($match5[1][0]);
        $expire   = trim($match5[2][0]);
        
        return "*User:* `$username`\n*Senha:* `$password`\n*IP:* `$ip`\n*Porta:* `443`\n*Host:* `$host`\n*Criado em:* `$created`\n*Expira em:* `$expire`";
    } else {
        return "*ERRO DESCONHECIDO, use o comando novamente! Se o problema pessistir, notifique meu* [desenvolvedor.]($dev_link)";
    }
}

function gerar_username()
{
    
    $mi = "abcdefghijklmnopqrstuvyxwz";
    
    return substr(str_shuffle($mi), 0, 6);
}

function gerar_password()
{
    
    $nu = "0123456789";
    
    return substr(str_shuffle($nu), 0, 6);
}