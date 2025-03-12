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

        div {
            font-family: 'Poppins';
            font-weight: bold;
            width: 90vh;
            height: 90vh;
            text-align: center;
        }

        div p {
            font-size: 30px;
            text-align: center;
            padding: 0 20px;
        }

        div button {
            color: white;
            font-size: 30px;
            width: 20vh;
            margin-top: 5vh;
            padding-bottom: 2px;
            margin-bottom: 12px;
        }

        header {
            margin: 20px;
            font-size: 45px;
            position: relative;
            height: 40vh;
            
        }

        header h1 {
            cursor: pointer;
            color: white;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 10px;
            margin: 10px;
            text-shadow: 
                -1px -1px 0 black,
                1px -1px 0 black,
                -1px 1px 0 black,
                1px 1px 0 black;
            position: absolute;
        }

        header h1:hover {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        /* main{
            background-color:rgb(223, 223, 223);
            border-radius: 50px;
            box-shadow: 2px black;
        } */ 

        .active-title {
            color: #5DFDF3 !important;
            text-shadow: 
                -1px -1px 0 black,
                1px -1px 0 black,
                -1px 1px 0 black,
                1px 1px 0 black;
        }

        /* Novas posições */
        .top-left {
            left: 0;
            top: 0;
        }

        .top-right {
            right: 0;
            top: 0;
        }

        .bottom-center {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        #logo{
            position: absolute;
            right: 80vh;
            bottom: 37rem;
        }
    </style>
</head>
<body>
    <div>
        <header>
            <h1 data-section="vision" class="top-right">Visão</h1>
            <h1 data-section="values" class="top-left">Valores</h1>  
            <h1 data-section="mission" class="bottom-center active-title">Missão</h1>   
        </header>
        <img src="./assets/img/logoSobre.png" alt="" id="logo"> 

        <main>
        <p>Ser a plataforma líder globalmente em aprendizado interativo de informática e tecnologia, oferecendo desafios estimulantes e conteúdo relevante para todos os níveis de habilidade.</p>
        <a href="home.php">
            <button class="cursor-pointer transition-all bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-b-[8px] border-r-[2px] border-l-[2px] border-t-[1px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                Voltar
            </button>
        </a>
        </main>
        
    </div>

    <script>
        const contents = {
            vision: {
                text: "Ser a plataforma líder globalmente em aprendizado interativo de informática e tecnologia, oferecendo desafios estimulantes e conteúdo relevante para todos os níveis de habilidade.",
            },
            values: {
                text: "Excelência, Inovação e Comunidade. Estamos comprometidos em proporcionar a mais alta qualidade em educação tecnológica, impulsionados pela constante busca por novas ideias e pela construção de uma comunidade inclusiva e colaborativa.",
            },
            mission: {
                text: "Capacitar indivíduos a explorar e aprimorar seus conhecimentos em informática e tecnologia por meio de uma experiência educativa e envolvente, promovendo o aprendizado contínuo e a diversão.",
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const header = document.querySelector('header');
            const paragraph = document.querySelector('div p');

            function handleTitleClick(event) {
                const clickedTitle = event.target;
                if (!clickedTitle.matches('h1') || clickedTitle.classList.contains('bottom-center')) return;

                const currentBottom = header.querySelector('.bottom-center');
                
                // Remove classes ativas
                header.querySelectorAll('h1').forEach(title => {
                    title.classList.remove('active-title');
                });

                // Troca as posições
                const clickedPositionClass = Array.from(clickedTitle.classList).find(c => c.startsWith('top-'));
                const bottomPositionClass = 'bottom-center';

                // Atualiza as classes
                clickedTitle.classList.remove(clickedPositionClass);
                clickedTitle.classList.add(bottomPositionClass);
                currentBottom.classList.remove(bottomPositionClass);
                currentBottom.classList.add(clickedPositionClass);

                // Atualiza conteúdo e estilo
                clickedTitle.classList.add('active-title');
                paragraph.textContent = contents[clickedTitle.dataset.section].text;
            }

            header.addEventListener('click', handleTitleClick);
        });
    </script>
</body>
</html>