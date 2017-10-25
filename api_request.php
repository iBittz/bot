<?php

function exec_curl_request($handle) {
  $response = curl_exec($handle);

  if ($response === false) {
    $errno = curl_errno($handle);
    $error = curl_error($handle);
    error_log("Curl retornou um erro $errno: $error\n");
    curl_close($handle);
    return false;
  }

  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
  curl_close($handle);

  if ($http_code >= 500) {
 // emitir erro caso o servidor esteja sobrecarregado: DDoS
    sleep(10);
    return false;
  } else if ($http_code != 200) {
    $response = json_decode($response, true);
    error_log("O pedido falhou com erro {$response['error_code']}: {$response['description']}\n");
    if ($http_code == 401) {
      throw new Exception('Token de acesso inválido.');
    }
    return false;
  } else {
    $response = json_decode($response, true);
    if (isset($response['description'])) {
      error_log("O pedido foi bem sucedido: {$response['description']}\n");
    }
    $response = $response['result'];
  }

  return $response;
}
// enviar e receber dados da api do telegram
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("O nome do método deve ser uma string!\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Os parâmetros devem ser um Array!\n");
    return false;
  }

  foreach ($parameters as $key => &$val) {
 // Codificação para parâmetros de Array JSON, por exemplo, reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = API_URL.$method.'?'.http_build_query($parameters);

  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);

  return exec_curl_request($handle);
}