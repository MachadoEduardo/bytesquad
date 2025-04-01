<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajustes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    body {
        background-image: url('./assets/img/background.png');
        background-size: cover;
        height: 100vh;
        overflow: hidden;
    }

    .text-stroke {
        text-shadow:
            -2px -2px 0 #0D0D36,
            2px -2px 0 #0D0D36,
            -2px 2px 0 #0D0D36,
            2px 2px 0 #0D0D36;
    }
</style>

<body class="flex items-center justify-center h-screen bg-purple-500">
    <div class="w-80 bg-white rounded-2xl shadow-lg p-4 relative">
        <a href="home.php"><button class="absolute top-2 right-2 text-xl">❌</button></a>
        <h1 class="text-center text-3xl font-bold text-[#5DFDF3] text-stroke">Ajustes</h1>

        <div class="mt-4">
            <label class="block text-sm font-semibold text-center">Volume</label>
            <input type="range" class="w-full accent-blue-500">
        </div>

        <div class="mt-4">
            <label class="block text-sm font-semibold text-center">Música</label>
            <input type="range" class="w-full accent-blue-500" id="volumeControl"
                min="0" max="1" step="0.01" value="<?= $_COOKIE['musicVolume'] ?? 0.0 ?>">
        </div>

        <div class="mt-4 text-center">
            <p class="text-sm font-semibold">Notificações</p>
            <div class="flex justify-center space-x-2 mt-2">
                <button class="bg-green-500 text-white px-4 py-1 rounded">Ligado</button>
                <button class="bg-white border px-4 py-1 rounded">Desligado</button>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="text-sm font-semibold">Modo Noturno</p>
            <div class="flex justify-center space-x-2 mt-2">
                <button class="bg-white border px-4 py-1 rounded">Ligado</button>
                <button class="bg-red-500 text-white px-4 py-1 rounded">Desligado</button>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-semibold text-center">Feedback</label>
            <textarea class="w-full border rounded p-2"></textarea>
        </div>

        <button class="w-full mt-4 bg-blue-400 text-white py-2 rounded">Enviar</button>
    </div>

    <audio id="backgroundMusic" autoplay loop hidden>
        <source src="./assets/audios/Frank-Ocean-Siegfried-(HipHopKit.com).mp3" type="audio/mpeg">
    </audio>

    <script>
        const audio = document.getElementById("backgroundMusic");

        // Inicialização do volume salvo no localStorage
        let savedVolume = localStorage.getItem("musicVolume") || 0.5;
        audio.volume = savedVolume;

        // Controle de volume via input range
        document.getElementById("volumeControl").addEventListener("input", (e) => {
            let volume = e.target.value;
            audio.volume = volume;
            localStorage.setItem("musicVolume", volume);
        });

        // Forçar o autoplay após a página carregar e garantir que ele não seja bloqueado
        document.addEventListener("DOMContentLoaded", () => {
            const playAudio = () => {
                audio.play().then(() => {
                    console.log("Música tocando automaticamente 🎵");
                }).catch((error) => {
                    console.warn("Autoplay bloqueado! Esperando interação do usuário...");
                });
            };

            // Toca imediatamente se o navegador permitir
            playAudio();

            // Caso tenha sido bloqueado, espera o primeiro clique ou toque do usuário
            document.addEventListener("click", playAudio, {
                once: true
            });
        });
    </script>
</body>

</html>