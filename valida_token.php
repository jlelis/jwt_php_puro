<?php

//função para correção de "tratamanto" de alguns caracteres que não podem conter no JWT
function base64UrlEncode($data)
{
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
}
//pega o token gerado na index para comparação
$token = '[colar_o_token_aqui]';
$key="segredo";

//separar o token
$parts = explode('.', $token);

//refazer a assinatura
$signature = base64UrlEncode(
    hash_hmac('sha256', $parts[0] . '.' . $parts[1], $key, true)
);

//comparar com a assinatura que vem do token
if ($signature == $parts[2]) {
    //refazer o Payload com json_decode e base64_decode
    $payload = json_decode(
        base64_decode($parts[1])
    );
    //pegar a propridade nome
    echo "Nome: " . $payload->name;

} else {

    echo "token invalido";
}


