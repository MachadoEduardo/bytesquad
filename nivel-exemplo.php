<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Nível - ByteSquad</title>
    <style>
        .question { display: none; }
        .active-question { display: block; }
        .feedback { display: none; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center">
    <div class="container mx-auto max-w-2xl px-4">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-[#3C3C3C]">Perguntas</h1>
                <div class="flex space-x-2" id="progress">
                    <div class="w-3 h-3 rounded-full bg-gray-200"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-200"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-200"></div>
                </div>
            </div>

            <div class="question active-question" data-question="1">
                <p class="text-lg font-medium text-gray-700 mb-4">Qual tag HTML é usada para um cabeçalho de nível 1?</p>
                <div class="space-y-3">
                    <button onclick="checkAnswer(event, false)" class="answer-btn">&lt;header&gt;</button>
                    <button onclick="checkAnswer(event, true)" class="answer-btn">&lt;h1&gt;</button>
                    <button onclick="checkAnswer(event, false)" class="answer-btn">&lt;head&gt;</button>
                </div>
            </div>

            <div class="question" data-question="2">
                <p class="text-lg font-medium text-gray-700 mb-4">Qual propriedade CSS define a cor do texto?</p>
                <div class="space-y-3">
                    <button onclick="checkAnswer(event, true)" class="answer-btn">color</button>
                    <button onclick="checkAnswer(event, false)" class="answer-btn">background-color</button>
                    <button onclick="checkAnswer(event, false)" class="answer-btn">font-color</button>
                </div>
            </div>

            <div class="question" data-question="3">
                <p class="text-lg font-medium text-gray-700 mb-4">Qual tag HTML cria um link?</p>
                <div class="space-y-3">
                    <button onclick="checkAnswer(event, false)" class="answer-btn">&lt;link&gt;</button>
                    <button onclick="checkAnswer(event, true)" class="answer-btn">&lt;a&gt;</button>
                    <button onclick="checkAnswer(event, false)" class="answer-btn">&lt;href&gt;</button>
                </div>
            </div>

            <div id="feedback" class="hidden mt-6 p-4 rounded-lg text-center">
                <span id="feedback-text"></span>
                <button onclick="nextQuestion()" class="mt-4 w-full bg-[#58CC02] hover:bg-[#4CB302] text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Próxima Questão
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentQuestion = 1;
        const totalQuestions = 3;

        function checkAnswer(event, isCorrect) {
            const btn = event.target;
            
            document.querySelectorAll('.answer-btn').forEach(b => {
                b.classList.remove('bg-green-500', 'text-white', 'bg-red-500');
            });

            if(isCorrect) {
                btn.classList.add('bg-green-500', 'text-white');
            } else {
                btn.classList.add('bg-red-500', 'text-white');
            }

            const feedback = document.getElementById('feedback');
            const feedbackText = document.getElementById('feedback-text');
            
            feedbackText.innerHTML = isCorrect 
                ? '🎉 Resposta Correta!' 
                : '❌ Resposta Incorreta!';
            
            feedback.classList.remove('hidden');
            feedback.className = `mt-6 p-4 rounded-lg text-center ${isCorrect ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`;
        }

        function nextQuestion() {
            currentQuestion++;
            
            document.querySelectorAll('#progress div').forEach((dot, index) => {
                if(index < currentQuestion - 1) {
                    dot.classList.add('bg-[#58CC02]');
                    dot.classList.remove('bg-gray-200');
                }
            });

            document.querySelectorAll('.question').forEach(q => {
                q.classList.remove('active-question');
                if(q.dataset.question == currentQuestion) {
                    q.classList.add('active-question');
                }
            });

            document.getElementById('feedback').classList.add('hidden');
            
            document.querySelectorAll('.answer-btn').forEach(b => {
                b.classList.remove('bg-green-500', 'text-white', 'bg-red-500');
            });

            if(currentQuestion > totalQuestions) {
                alert('Parabéns! Você completou o nível!');
                window.location.href = 'listar_niveis.php';
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
        }

        .answer-btn:hover {
            background-color: #f3f4f6;
        }
    </style>
</body>
</html>