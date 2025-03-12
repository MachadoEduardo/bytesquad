<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Potta One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sobre</title>
    <style>
        body {
            background-image: url('./assets/img/background.png');
            background-size: cover;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        main {
            font-family: 'Poppins';
            font-weight: bold;
            border: 2px solid;
            width: 80vh;
            height: 80vh;
            text-align: center;
        }

        header {
            border: 1px solid white;
            justify-items: center;
            margin: 20px;
            font-size: 45px;
        }

        main p {
            font-size: 30px;
            text-align: center;
        }

        main button {
            color: white;
            font-size: 30px;
            width: 20vh;
            margin-top: 5vh;
        }

        header h1 {
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 10px;
            margin: 10px;
        }

        header h1:hover {
            transform: scale(1.05);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <main>
        <header>
            <h1 data-section="vision" class="">Visão</h1>
            <h1 data-section="values">Valores</h1>
            <h1 data-section="mission">Missão</h1>
        </header>

        <p>Ser a plataforma líder globalmente em aprendizado interativo de informática e tecnologia, oferecendo desafios estimulantes e conteúdo relevante para todos os níveis de habilidade.</p>
        <a href="">
            <button class="cursor-pointer transition-all bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-b-[8px] border-r-[2px] border-l-[2px] border-t-[1px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                Voltar
            </button>
        </a>
    </main>

    <!-- Script corrigido -->
    <script>
        const contents = {
            vision: {
                text: "Ser a plataforma líder globalmente em aprendizado interativo de informática e tecnologia, oferecendo desafios estimulantes e conteúdo relevante para todos os níveis de habilidade.",
                order: ["vision", "values", "mission"]
            },
            values: {
                text: "Excelência, Inovação e Comunidade. Estamos comprometidos em proporcionar a mais alta qualidade em educação tecnológica, impulsionados pela constante busca por novas ideias e pela construção de uma comunidade inclusiva e colaborativa.",
                order: ["values", "vision", "mission"]
            },
            mission: {
                text: "Capacitar indivíduos a explorar e aprimorar seus conhecimentos em informática e tecnologia por meio de uma experiência educativa e envolvente, promovendo o aprendizado contínuo e a diversão.",
                order: ["mission", "values", "vision"]
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const header = document.querySelector('header');
            const paragraph = document.querySelector('main p');

            // Função para tratar cliques nos títulos
            function handleTitleClick(event) {
                const title = event.target;
                if (title.tagName === 'H1') {
                    const section = title.dataset.section;
                    updateContent(section);
                    reorderTitles(section);
                }
            }

            // Event delegation no header
            header.addEventListener('click', handleTitleClick);

            function updateContent(section) {
                paragraph.textContent = contents[section].text;
            }

            function reorderTitles(activeSection) {
                const newOrder = contents[activeSection].order;
                const newElements = newOrder.map(section => 
                    Array.from(header.children).find(child => 
                        child.dataset.section === section
                    )
                );
                
                // Remove todos os elementos
                while (header.firstChild) {
                    header.removeChild(header.firstChild);
                }
                
                // Adiciona na nova ordem
                newElements.forEach(element => {
                    header.appendChild(element);
                });
            }
        });
    </script>
</body>
</html>