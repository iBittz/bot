 <?php

function cep_chk($cep)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://m.correios.com.br/movel/buscaCepConfirma.do");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        "cepEntrada" => $cep,
        "metodo" => "buscarCep"
    )));
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $dados = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($dados, "Logradouro") !== false) {
        
        preg_match_all("(<span class=\"respostadestaque\">(.*)</span>)siU", $dados, $match);
        
        $logradouro = utf8_encode(trim($match[1][0]));
        $bairro     = utf8_encode(trim($match[1][1]));
        
        list($cid, $est) = explode("/", $match[1][2], 2);
        
        $cidade = utf8_encode(trim($cid));
        $estado = utf8_encode(trim($est));
        
        return "*CEP:* `$cep`\n*Endereço:* `$logradouro`\n*Bairro:* `$bairro`\n*Cidade:* `$cidade`\n*Estado:* `$estado`";
    } else {
        return "*CEP inválido!*";
    }
}