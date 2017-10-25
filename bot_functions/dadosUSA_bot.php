 <?php
function dadosUSA()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.fakenamegenerator.com/gen-random-us-us.php");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $data = curl_exec($ch);
    curl_close($ch);
    
    preg_match_all("(<h3>(.*)</h3>)siU", $data, $match1);
    preg_match_all("(<div class=\"adr\">(.*)<br/>(.*)</div>)siU", $data, $match2);
    preg_match_all("(<div class=\"adr\">(.*)<br/>(.*)</div>)siU", $data, $match3);
    preg_match_all("(<dt>SSN</dt><dd>(.*)<div class=\"adtl\">)siU", $data, $match4);
    preg_match_all("(<dd>(.*)</dd>)siU", $data, $match5);
    
    $name   = trim($match1[1][0]);
    $street = trim($match2[1][0]);
    $addr0  = explode(",", trim($match3[2][0]));
    $addr1  = explode(" ", $addr0[1]);
    $ssn    = substr(trim($match4[1][0]), 0, 7);
    $phone  = trim($match5[1][3]);
    
    return "*Nome:* `$name`\n*País:* `United States`\n*Endereço:* `$street`\n*Cidade:* `" . $addr0[0] . "`\n*Estado:* `" . $addr1[1] . "`\n*Zip Code:* `" . $addr1[2] . "`\n*Dt. Nasc:* `" . GerarData() . "`\n*SSN:* `" . $ssn . GerarSSN() . "`\n*Tel:* `+1 " . $phone . "`";
}
function GerarData()
{
    $diaa = mt_rand(1, 30);
    $dia  = (($diaa < 10) ? '0' . $diaa : $diaa);
    $mesr = mt_rand(1, 12);
    $mes  = (($mesr < 10) ? '0' . $mesr : $mesr);
    $ano  = mt_rand(1960, 1994);
    
    return $dia . "/" . $mes . "/" . $ano;
}
function GerarSSN()
{
    $num = mt_rand(0000, 9999);
    
    return $num;
} 