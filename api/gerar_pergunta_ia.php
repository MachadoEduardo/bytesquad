<?php
$apiKey = getenv('OPENAI_API_KEY');; // substitua pela sua chave API

$tema = $_POST['tema'] ?? '';
$nivel = $_POST['nivel'] ?? '';
$promptCustom = $_POST['prompt'] ?? '';

if ($promptCustom) {
    $prompt = $promptCustom;
} else {
    $prompt = "Crie uma pergunta de múltipla escolha sobre \"$tema\" para alunos do nível \"$nivel\".

Responda apenas com o seguinte JSON. NÃO inclua texto antes ou depois:

{
   \"id_nivel\": \"$nivel\",
  \"pergunta\": \"Qual é a pergunta?\",
  \"alternativas\": {
    \"A\": \"Alternativa A\",
    \"B\": \"Alternativa B\",
    \"C\": \"Alternativa C\",
    \"D\": \"Alternativa D\"
  },
  \"correta\": \"A\"
}";
}

$data = [
    "model" => "gpt-4o",
    "messages" => [
        ["role" => "system", "content" => "Você é um gerador de perguntas de múltipla escolha para quizzes educacionais."],
        ["role" => "user", "content" => $prompt]
    ],
    "max_tokens" => 300,
    "temperature" => 0.7
];

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);

$respostaBruta = $responseData['choices'][0]['message']['content'] ?? '';
file_put_contents('debug_ia.txt', $respostaBruta); // para debug

$respostaJson = trim($respostaBruta);

$jsonResposta = json_decode($respostaJson, true);

if (is_array($jsonResposta) &&
    isset($jsonResposta['pergunta']) &&
    isset($jsonResposta['alternativas']) &&
    isset($jsonResposta['correta'])) {

    echo json_encode([
        'pergunta' => $jsonResposta['pergunta'],
        'alternativas' => $jsonResposta['alternativas'],
        'correta' => $jsonResposta['correta']
    ]);
} else {
    // fallback para debug se algo falhar
    echo json_encode([
        'pergunta' => '',
        'alternativas' => [],
        'correta' => '',
        'debug' => $respostaBruta
    ]);
}
