<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Nível: Fundamentos de Desenvolvimento Web - ByteSquad</title>
    <style>
        .question { display: none; }
        .active-question { display: block; }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .pulse-animation {
            animation: pulse 0.6s;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 to-purple-100 min-h-screen flex items-center py-8">
    <div class="container mx-auto max-w-2xl px-4">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-indigo-600 p-6 text-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Fundamentos de Web</h1>
                    <div class="flex items-center space-x-2">
                        <span id="questionCounter" class="text-sm font-medium">1/7</span>
                    </div>
                </div>
                <div class="mt-4 w-full bg-indigo-300 rounded-full h-2.5">
                    <div id="progressBar" class="bg-green-400 h-2.5 rounded-full" style="width: 14%"></div>
                </div>
            </div>

            <div class="p-8">
                <div id="questionContainer">
                    
                </div>

                <div id="feedback" class="hidden mt-6 p-4 rounded-lg text-center">
                    <div class="flex flex-col items-center">
                        <div id="feedback-icon" class="text-4xl mb-2"></div>
                        <p id="feedback-text" class="text-lg font-medium"></p>
                        <p id="feedback-explanation" class="text-gray-600 mt-2"></p>
                    </div>
                    <button id="nextButton" class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                        Próxima Questão
                    </button>
                </div>
            </div>
        </div>

        <div id="resultScreen" class="hidden bg-white rounded-2xl shadow-lg p-8 mt-6 text-center">
            <div class="py-6">
                <div id="finalScore" class="text-5xl font-bold text-indigo-600 mb-2">0/7</div>
                <div id="scoreMessage" class="text-xl font-medium text-gray-700 mb-6">Você pode melhorar!</div>
                
                <div class="mb-8">
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div id="finalProgressBar" class="bg-indigo-600 h-4 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
                
                <p class="text-gray-600 mb-8">Continue praticando para dominar os fundamentos de desenvolvimento web!</p>
                
                <div class="flex flex-col space-y-3">
                    <button onclick="window.location.reload()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                        Tentar Novamente
                    </button>
                    <button onclick="window.location.href='listar_niveis.php'" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition-colors">
                        Voltar para Níveis
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const nivelId = <?php echo isset($_GET['id_nivel']) ? intval($_GET['id_nivel']) : 1; ?>;
        let perguntas = [];
        let currentQuestion = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;

        let explicacoes = {};

        fetch(`api/perguntas_respostas.php?id_nivel=${nivelId}`)
            .then(res => res.json())
            .then(data => {
                perguntas = data;
                totalQuestions = perguntas.length;
                perguntas.forEach((q, idx) => {
                    explicacoes[idx] = q.explicacao || ""; // se quiser adicionar explicação no banco
                });
                renderQuestion();
                updateProgress();
            });

        function renderQuestion() {
            if (currentQuestion >= perguntas.length) {
                showResults();
                return;
            }
            const q = perguntas[currentQuestion];
            let html = `<div class="question active-question">
                <p class="text-lg font-medium text-gray-800 mb-4">${q.texto_pergunta}</p>
                <div class="space-y-3">`;
            q.respostas.forEach(r => {
                html += `<button data-correct="${r.correta == 1}" class="answer-btn">${r.texto_resposta}</button>`;
            });
            html += `</div></div>`;
            document.getElementById('questionContainer').innerHTML = html;

            document.querySelectorAll('.answer-btn').forEach(button => {
                button.addEventListener('click', function() {
                    checkAnswer(this);
                });
            });

            // Atualiza contador
            document.getElementById('questionCounter').textContent = `${currentQuestion + 1}/${totalQuestions}`;
        }

        function checkAnswer(buttonElement) {
            document.querySelectorAll('.answer-btn').forEach(b => {
                b.disabled = true;
                b.classList.add('opacity-70');
            });

            const isCorrect = buttonElement.getAttribute('data-correct') === 'true';
            const feedback = document.getElementById('feedback');
            const feedbackText = document.getElementById('feedback-text');
            const feedbackIcon = document.getElementById('feedback-icon');
            const feedbackExplanation = document.getElementById('feedback-explanation');

            if(isCorrect) {
                buttonElement.classList.add('bg-green-500', 'text-white');
                feedbackText.textContent = 'Resposta Correta!';
                feedbackIcon.textContent = '🎉';
                correctAnswers++;
            } else {
                buttonElement.classList.add('bg-red-500', 'text-white');
                feedbackText.textContent = 'Resposta Incorreta!';
                feedbackIcon.textContent = '❌';

                document.querySelectorAll('.answer-btn').forEach(b => {
                    if(b.getAttribute('data-correct') === 'true') {
                        b.classList.add('bg-green-100', 'border-2', 'border-green-500');
                    }
                });
            }

            feedbackExplanation.innerHTML = explicacoes[currentQuestion] || "";
            feedback.className = `mt-6 p-4 rounded-lg text-center ${isCorrect ? 'bg-green-100' : 'bg-red-100'}`;
            buttonElement.classList.add('pulse-animation');
            feedback.classList.remove('hidden');
        }

        document.getElementById('nextButton').addEventListener('click', nextQuestion);

        function updateProgress() {
            const percentage = (currentQuestion / totalQuestions) * 100;
            document.getElementById('progressBar').style.width = `${percentage}%`;
            document.getElementById('questionCounter').textContent = `${currentQuestion + 1}/${totalQuestions}`;
        }

        function nextQuestion() {
            document.getElementById('feedback').classList.add('hidden');
            currentQuestion++;
            updateProgress();
            renderQuestion();
        }

        function showResults() {
            document.getElementById('questionContainer').classList.add('hidden');
            document.getElementById('feedback').classList.add('hidden');

            const resultScreen = document.getElementById('resultScreen');
            resultScreen.classList.remove('hidden');

            const scorePercentage = (correctAnswers / totalQuestions) * 100;
            document.getElementById('finalScore').textContent = `${correctAnswers}/${totalQuestions}`;
            document.getElementById('finalProgressBar').style.width = `${scorePercentage}%`;

            const scoreMessage = document.getElementById('scoreMessage');
            if(scorePercentage >= 90) {
                scoreMessage.textContent = 'Excelente! Você domina o assunto!';
                resultScreen.classList.add('bg-green-50');
                document.getElementById('finalScore').classList.add('text-green-600');
            } else if(scorePercentage >= 70) {
                scoreMessage.textContent = 'Muito bom! Você está quase lá!';
                resultScreen.classList.add('bg-blue-50');
                document.getElementById('finalScore').classList.add('text-blue-600');
            } else if(scorePercentage >= 50) {
                scoreMessage.textContent = 'Bom trabalho! Continue estudando.';
                resultScreen.classList.add('bg-yellow-50');
                document.getElementById('finalScore').classList.add('text-yellow-600');
            } else {
                scoreMessage.textContent = 'Continue praticando. Você vai melhorar!';
                resultScreen.classList.add('bg-red-50');
                document.getElementById('finalScore').classList.add('text-red-600');
            }
        }
    </script>

    <style>
        .answer-btn {
            width: 100%;
            padding: 1rem;
            text-align: left;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .answer-btn:hover:not(:disabled) {
            background-color: #f3f4f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</body>
</html>