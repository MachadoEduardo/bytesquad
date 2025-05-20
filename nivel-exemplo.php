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
                    <div class="question active-question" data-question="1">
                        <p class="text-lg font-medium text-gray-800 mb-4">Qual tag HTML é usada para criar um cabeçalho de nível 1?</p>
                        <div class="space-y-3">
                            <button data-correct="false" class="answer-btn">&lt;header&gt;</button>
                            <button data-correct="true" class="answer-btn">&lt;h1&gt;</button>
                            <button data-correct="false" class="answer-btn">&lt;heading&gt;</button>
                            <button data-correct="false" class="answer-btn">&lt;title&gt;</button>
                        </div>
                    </div>

                    <div class="question" data-question="2">
                        <p class="text-lg font-medium text-gray-800 mb-4">Qual propriedade CSS define a cor do texto?</p>
                        <div class="space-y-3">
                            <button data-correct="true" class="answer-btn">color</button>
                            <button data-correct="false" class="answer-btn">text-color</button>
                            <button data-correct="false" class="answer-btn">font-color</button>
                            <button data-correct="false" class="answer-btn">text-style</button>
                        </div>
                    </div>

                    <div class="question" data-question="3">
                        <p class="text-lg font-medium text-gray-800 mb-4">Qual das seguintes opções é um framework JavaScript?</p>
                        <div class="space-y-3">
                            <button data-correct="false" class="answer-btn">Bootstrap</button>
                            <button data-correct="true" class="answer-btn">React</button>
                            <button data-correct="false" class="answer-btn">Sass</button>
                            <button data-correct="false" class="answer-btn">Flask</button>
                        </div>
                    </div>

                    <div class="question" data-question="4">
                        <p class="text-lg font-medium text-gray-800 mb-4">O que significa a sigla API?</p>
                        <div class="space-y-3">
                            <button data-correct="false" class="answer-btn">Application Programming Installation</button>
                            <button data-correct="false" class="answer-btn">Automatic Programming Interface</button>
                            <button data-correct="true" class="answer-btn">Application Programming Interface</button>
                            <button data-correct="false" class="answer-btn">Advanced Programming Integration</button>
                        </div>
                    </div>

                    <div class="question" data-question="5">
                        <p class="text-lg font-medium text-gray-800 mb-4">Qual método HTTP é normalmente usado para enviar dados de um formulário?</p>
                        <div class="space-y-3">
                            <button data-correct="false" class="answer-btn">GET</button>
                            <button data-correct="true" class="answer-btn">POST</button>
                            <button data-correct="false" class="answer-btn">DELETE</button>
                            <button data-correct="false" class="answer-btn">PUT</button>
                        </div>
                    </div>

                    <div class="question" data-question="6">
                        <p class="text-lg font-medium text-gray-800 mb-4">Qual linguagem é usada para estilizar páginas web?</p>
                        <div class="space-y-3">
                            <button data-correct="false" class="answer-btn">JavaScript</button>
                            <button data-correct="false" class="answer-btn">HTML</button>
                            <button data-correct="true" class="answer-btn">CSS</button>
                            <button data-correct="false" class="answer-btn">PHP</button>
                        </div>
                    </div>

                    <div class="question" data-question="7">
                        <p class="text-lg font-medium text-gray-800 mb-4">Qual tag HTML cria um link para outra página?</p>
                        <div class="space-y-3">
                            <button data-correct="false" class="answer-btn">&lt;link&gt;</button>
                            <button data-correct="true" class="answer-btn">&lt;a&gt;</button>
                            <button data-correct="false" class="answer-btn">&lt;href&gt;</button>
                            <button data-correct="false" class="answer-btn">&lt;url&gt;</button>
                        </div>
                    </div>
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
        let currentQuestion = 1;
        const totalQuestions = 7;
        let correctAnswers = 0;

        const explanations = {
            1: "A tag &lt;h1&gt; é usada para criar cabeçalhos de primeiro nível, sendo o mais importante da página. Os cabeçalhos vão de &lt;h1&gt; a &lt;h6&gt;.",
            2: "A propriedade 'color' do CSS define a cor do texto de um elemento. Por exemplo: color: blue;",
            3: "React é um framework JavaScript para construção de interfaces de usuário, desenvolvido pelo Facebook.",
            4: "API (Application Programming Interface) é um conjunto de rotinas e padrões que permite a comunicação entre diferentes softwares.",
            5: "O método POST é usado para enviar dados ao servidor, especialmente útil para formulários, pois os dados não aparecem na URL.",
            6: "CSS (Cascading Style Sheets) é a linguagem usada para estilizar elementos HTML, controlando layout, cores e fontes.",
            7: "A tag &lt;a&gt; (anchor) é usada para criar links em HTML. O atributo href especifica o destino do link."
        };

        document.querySelectorAll('.answer-btn').forEach(button => {
            button.addEventListener('click', function() {
                checkAnswer(this);
            });
        });

        document.getElementById('nextButton').addEventListener('click', nextQuestion);

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

            feedbackExplanation.innerHTML = explanations[currentQuestion];

            feedback.className = `mt-6 p-4 rounded-lg text-center ${isCorrect ? 'bg-green-100' : 'bg-red-100'}`;

            buttonElement.classList.add('pulse-animation');

            feedback.classList.remove('hidden');
        }
        
        function updateProgress() {
            const percentage = ((currentQuestion - 1) / totalQuestions) * 100;
            document.getElementById('progressBar').style.width = `${percentage}%`;
            document.getElementById('questionCounter').textContent = `${currentQuestion}/${totalQuestions}`;
        }

        function nextQuestion() {
            document.querySelectorAll('.answer-btn').forEach(b => {
                b.classList.remove('pulse-animation');
                b.disabled = false;
                b.classList.remove('opacity-70', 'bg-green-500', 'text-white', 'bg-red-500', 'bg-green-100', 'border-2', 'border-green-500');
            });

            currentQuestion++;

            updateProgress();

            document.getElementById('feedback').classList.add('hidden');

            if(currentQuestion > totalQuestions) {
                showResults();
                return;
            }

            document.querySelectorAll('.question').forEach(q => {
                q.classList.remove('active-question');
                if(q.dataset.question == currentQuestion) {
                    q.classList.add('active-question');
                }
            });
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