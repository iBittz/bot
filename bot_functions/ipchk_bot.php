 <?php
function IP_Chk($ip)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . $ip);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($data, 'success') !== false) {
        
        $ipv4 = json_decode($data);
        
        $host   = $ipv4->{"query"};
        $pais   = $ipv4->{"country"} == "" ? "N/A" : $ipv4->{"country"};
        $cidade = $ipv4->{"city"} == "" ? "N/A" : $ipv4->{"city"};
        $estado = $ipv4->{"regionName"} == "" ? "N/A" : $ipv4->{"regionName"};
        $isp    = $ipv4->{"isp"} == "" ? "N/A" : $ipv4->{"isp"};
        $lat    = $ipv4->{"lat"} == "" ? "N/A" : $ipv4->{"lat"};
        $lon    = $ipv4->{"lon"} == "" ? "N/A" : $ipv4->{"lon"};
        $zip    = $ipv4->{"zip"} == "" ? "N/A" : $ipv4->{"zip"};
        $as     = $ipv4->{"as"} == "" ? "N/A" : $ipv4->{"as"};
        $time   = $ipv4->{"timezone"} == "" ? "N/A" : $ipv4->{"timezone"};
        
        return "*HOST/IP:* `$host`\n*País:* `$pais`\n*Estado:* `$estado`\n*Cidade:* `$cidade`\n*AS:* `$as`\n*ISP:* `$isp`\n*Latitude:* `$lat`\n*Longitude:* `$lon`\n*Time Zone:* `$time`\n*Código Postal:* `$zip`";
        
    } else {
        return "*Host inválido!*";
    }
} 