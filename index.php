<?php
// script para geração de token JWT manualmente

//segredo alguma chave unica para a identificação
$key = "segredo";

//função para correção de "tratamanto" de alguns caracteres que não podem conter no JWT
function base64UrlEncode($data)
{
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
}

//Header padrão
$header = base64UrlEncode('{"alg":"HS256","typ":"JWT"}');

//Payload qualquer dados
$payload = base64UrlEncode(
    '{"sub": "' . md5(time()) . '", "name": "JLelis","iat": ' . time() . '}'
);
//exemplo de um payload qualquer
//$payload = base64UrlEncode('{
//  "sub": "usuario@email.com",
//  "role": "ROLE_USUARIO",
//  "created": 1598536793689,
//  "exp": 1598636792
//}');

//montando a assinatura
$signature = base64UrlEncode(
    hash_hmac('sha256', $header . '.' . $payload, $key, true)
);

//mostra token montado
echo $header . '.' . $payload . '.' . $signature;