<?php
session_start();
$pacotes = [
    [
        'id' => 1,
        'nome' => 'Em destaque',
        'tipo' => 'highlight',
        'recursos' => [
            [
                'icone' => 'bolt',
                'titulo' => 'Energia infinita',
                'descricao' => 'Duração: 24h'
            ],
            [
                'icone' => 'dice',
                'titulo' => 'Pacote com 30 dicas',
                'descricao' => ''
            ]
        ],
        'preco' => 15.90
    ],
    [
        'id' => 2,
        'nome' => 'Pacote custo-benefício',
        'tipo' => 'value',
        'recursos' => [
            [
                'icone' => 'bolt',
                'titulo' => 'Tempo 3x',
                'descricao' => "mais rápido\nDuração: 10min"
            ],
            [
                'icone' => 'dice',
                'titulo' => 'Pacote pequeno',
                'descricao' => 'com 10 dicas'
            ]
        ],
        'preco' => 6.90
    ],
    [
        'id' => 3,
        'nome' => 'Pacote Squad',
        'tipo' => 'squad',
        'recursos' => [
            [
                'icone' => 'bolt',
                'titulo' => 'Energia infinita',
                'descricao' => 'Duração: 48h'
            ],
            [
                'icone' => 'dice',
                'titulo' => 'Pacote com 70 dicas',
                'descricao' => ''
            ]
        ],
        'preco' => 31.90
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Pacotes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap');
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #2D1B69;
            background-image: url('assets/img/pattern-bg.svg');
            background-size: 200px;
            overflow-x: hidden;
        }
        
        .package-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .package-header {
            border-radius: 16px 16px 0 0;
            text-align: center;
            padding: 12px;
            font-weight: 800;
            font-size: 18px;
        }
        
        .package-body {
            border-radius: 0 0 16px 16px;
            padding: 20px;
        }
        
        .price-bubble {
            border-radius: 50px;
            font-weight: 700;
            font-size: 18px;
            padding: 8px 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 5;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .price-bubble:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        
        .price-bubble:active {
            transform: scale(0.98);
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
        }
        
        .lightning {
            color: #FFD600;
            background-color: rgba(255, 214, 0, 0.2);
        }
        
        .dice {
            color: #FF9A00;
            background-color: rgba(255, 154, 0, 0.2);
        }
        
        .header-highlight {
            background-color: #F0C875;
            color: #8A5D00;
            box-shadow: 0 4px 0 #DBA646;
        }
        
        .header-value {
            background-color: #5CD6B9;
            color: #00664A;
            box-shadow: 0 4px 0 #41B89D;
        }
        
        .header-squad {
            background-color: #FF6B6B;
            color: #fff;
            box-shadow: 0 4px 0 #D85555;
        }
        
        .body-highlight {
            background-color: #FFF8E1;
            border: 2px solid #F0C875;
        }
        
        .body-value {
            background-color: #E6FFF8;
            border: 2px solid #5CD6B9;
        }
        
        .body-squad {
            background-color: #FFE9E9;
            border: 2px solid #FF6B6B;
        }
        
        .price-highlight {
            background-color: #5CD6B9;
            color: white;
        }
        
        .price-value {
            background-color: #5CD6B9;
            color: white;
        }
        
        .price-squad {
            background-color: #5CD6B9;
            color: white;
        }
        
        .btn-close {
            position: absolute;
            top: 3vh;
            right: 3vw;
            background-color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 10;
            transition: transform 0.2s ease;
        }
        
        .btn-close:hover {
            transform: rotate(90deg);
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background-color: white;
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .modal.active .modal-content {
            transform: scale(1);
            opacity: 1;
        }
        
        .page-title {
            color: white;
            text-align: center;
            font-weight: 800;
            font-size: 32px;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="min-h-screen p-4 md:p-8">
    <div class="container mx-auto max-w-lg">
        <h1 class="page-title">Loja de Pacotes</h1>
        <a href="#" class="btn-close" onclick="voltarTela(); return false;">
                <i class="fas fa-times text-gray-700 text-xl"></i>
            </a>
        
        <div class="relative flex flex-col items-center">
            
            <?php foreach ($pacotes as $pacote): ?>
                <div class="package-card mb-6 w-full max-w-md">
                    <div class="package-header header-<?php echo $pacote['tipo']; ?>">
                        <?php echo $pacote['nome']; ?>
                    </div>
                    <div class="package-body body-<?php echo $pacote['tipo']; ?>">
                        <div class="grid grid-cols-2 gap-4">
                            <?php foreach ($pacote['recursos'] as $recurso): ?>
                                <div class="flex items-center">
                                    <div class="feature-icon <?php echo $recurso['icone'] === 'bolt' ? 'lightning' : 'dice'; ?>">
                                        <i class="fas fa-<?php echo $recurso['icone']; ?> text-xl"></i>
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-bold"><?php echo $recurso['titulo']; ?></div>
                                        <?php if (!empty($recurso['descricao'])): ?>
                                            <?php 
                                            $linhas = explode("\n", $recurso['descricao']);
                                            foreach ($linhas as $linha): 
                                            ?>
                                                <div class="text-gray-600"><?php echo $linha; ?></div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="text-gray-600">&nbsp;</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="flex justify-center -mt-4">
                        <div class="price-bubble price-<?php echo $pacote['tipo']; ?>" 
                             onclick="comprarPacote(<?php echo $pacote['id']; ?>, <?php echo $pacote['preco']; ?>)">
                            R$ <?php echo number_format($pacote['preco'], 2, ',', '.'); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="modal-compra" class="modal">
        <div class="modal-content">
            <div class="text-right">
                <button onclick="fecharModal()" class="text-gray-500 hover:text-gray-800">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="modal-conteudo">
                <div class="text-center mb-6">
                    <div class="mx-auto bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-cart text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Confirmar Compra</h3>
                </div>
                <div id="modal-detalhes" class="mb-6">
                </div>
                <div class="flex justify-between">
                    <button onclick="fecharModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </button>
                    <button onclick="confirmarCompra()" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const packages = document.querySelectorAll('.package-card');
            
            packages.forEach((pack, index) => {
                setTimeout(() => {
                    pack.style.opacity = '1';
                    pack.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });

        let pacoteAtualId = 0;
        let pacoteAtualPreco = 0;
        let nomePacoteAtual = "";

        function voltarTela() {
            window.history.back();
        }

        function comprarPacote(id, valor) {
            pacoteAtualId = id;
            pacoteAtualPreco = valor;

            <?php foreach ($pacotes as $pacote): ?>
                if (<?php echo $pacote['id']; ?> === id) {
                    nomePacoteAtual = "<?php echo $pacote['nome']; ?>";
                }
            <?php endforeach; ?>

            document.getElementById('modal-conteudo').innerHTML = `
                <div class="text-center mb-6">
                    <div class="mx-auto bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-cart text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Confirmar Compra</h3>
                </div>
                <div id="modal-detalhes" class="mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-semibold text-lg mb-2">${nomePacoteAtual}</p>
                        <p class="text-gray-600 mb-3">Você está prestes a adquirir este pacote.</p>
                        <div class="flex justify-between items-center font-bold">
                            <span>Valor total:</span>
                            <span class="text-green-600">R$ ${valor.toFixed(2).replace('.', ',')}</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button onclick="fecharModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </button>
                    <button onclick="confirmarCompra()" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Confirmar
                    </button>
                </div>
            `;

            const modal = document.getElementById('modal-compra');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
        }

        function fecharModal() {
            const modal = document.getElementById('modal-compra');
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
        
        function confirmarCompra() {
            mostrarMensagemSucesso();
        }

        function mostrarMensagemSucesso() {
            document.getElementById('modal-conteudo').innerHTML = `
                <div class="text-center py-4">
                    <div class="mx-auto bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mb-4">
                        <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Compra Realizada!</h3>
                    <p class="text-gray-600 mb-6">O pacote "${nomePacoteAtual}" foi adquirido com sucesso.</p>
                    <button onclick="fecharModal()" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Continuar
                    </button>
                </div>
            `;
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modal-compra');
            if (event.target === modal) {
                fecharModal();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                fecharModal();
            }
        });
    </script>
</body>
</html>