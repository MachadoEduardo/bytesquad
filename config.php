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
        transition: all 0.3s ease;
    }

    .text-stroke {
        text-shadow:
            -2px -2px 0 #0D0D36,
            2px -2px 0 #0D0D36,
            -2px 2px 0 #0D0D36,
            2px 2px 0 #0D0D36;
    }

    .dark-mode {
        background-color: #1a1a2e;
        color: #f0f0f0;
    }

    .container-light {
        background-color: #ffffff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .container-light h1{
        
    }

    .container-dark {
        background-color: #2d3748;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        color: #f0f0f0;
    }

    .slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        height: 8px;
        border-radius: 10px;
        background: linear-gradient(90deg, #5DFDF3 0%, #5E60CE 100%);
        outline: none;
    }

    .slider-thumb::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #5E60CE;
        cursor: pointer;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .button-active {
        transform: scale(1.05);
        transition: all 0.2s ease;
    }

    textarea:focus, button:focus {
        outline: none;
        border-color: #5DFDF3;
        box-shadow: 0 0 0 2px rgba(93, 253, 243, 0.2);
    }
</style>

<body class="flex items-center justify-center h-screen">
    <div id="settings-container" class="w-96 rounded-3xl shadow-lg p-6 relative container-light transition-all duration-300">
        <a href="home.php">
            <button class="absolute top-4 right-4 text-xl hover:text-red-500 transition-colors">❌</button>
        </a>
        <h1 class="text-center text-3xl font-bold text-[#5DFDF3] mb-6">Configurações</h1>

        <div id="success-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 w-80 relative z-10 shadow-2xl transform transition-all duration-300">
                <button id="close-modal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Enviado com sucesso!</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-300">Seu feedback foi recebido. Agradecemos por nos ajudar a melhorar!</p>
                    <button id="confirm-modal" class="mt-4 inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-md hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        OK
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-semibold text-center mb-2">Volume Geral</label>
            <input type="range" class="w-full slider-thumb">
        </div>

        <div class="mt-6">
            <label class="block text-sm font-semibold text-center mb-2">Música de Fundo</label>
            <input type="range" class="w-full slider-thumb" id="volumeControl"
                min="0" max="1" step="0.01" value="0.5">
        </div>

        <div class="mt-6">
            <p class="text-sm font-semibold text-center mb-2">Notificações</p>
            <div class="flex justify-center space-x-4 mt-2">
                <button id="notifications-on" class="bg-green-500 text-white px-6 py-2 rounded-full font-medium hover:bg-green-600 button-active transition-all">Ligado</button>
                <button id="notifications-off" class="bg-gray-200 px-6 py-2 rounded-full font-medium hover:bg-red-600 transition-all">Desligado</button>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-sm font-semibold text-center mb-2">Modo Noturno</p>
            <div class="flex justify-center space-x-4 mt-2">
                <button id="dark-mode-on" class="bg-gray-200 px-6 py-2 rounded-full font-medium hover:bg-purple-500 transition-all">Ligado</button>
                <button id="dark-mode-off" class="bg-red-500 text-white px-6 py-2 rounded-full font-medium hover:bg-red-600 button-active transition-all">Desligado</button>
            </div>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-semibold text-center mb-2">Feedback</label>
            <textarea class="w-full border rounded-lg p-3 transition-all resize-none focus:ring-2 focus:ring-blue-400 text-black" rows="3" placeholder="Sua opinião é importante para nós..."></textarea>
        </div>

        <button class="w-full mt-6 bg-gradient-to-r from-blue-400 to-purple-500 text-white py-3 rounded-full font-bold hover:from-blue-500 hover:to-purple-600 transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-400">Enviar</button>
    </div>

    <audio id="backgroundMusic" autoplay loop hidden>
        <source src="./assets/audios/don-pollo-linggang-guli-guli-guli-wacha-made-with-Voicemod.mp3" type="audio/mpeg">
    </audio>

    <script>
        const audio = document.getElementById("backgroundMusic");
        const settingsContainer = document.getElementById("settings-container");
        const darkModeOnBtn = document.getElementById("dark-mode-on");
        const darkModeOffBtn = document.getElementById("dark-mode-off");
        const notificationsOnBtn = document.getElementById("notifications-on");
        const notificationsOffBtn = document.getElementById("notifications-off");
        const successModal = document.getElementById("success-modal");

        let savedVolume = localStorage.getItem("musicVolume") || 0.5;
        audio.volume = savedVolume;
        document.getElementById("volumeControl").value = savedVolume;

        document.getElementById("volumeControl").addEventListener("input", (e) => {
            let volume = e.target.value;
            audio.volume = volume;
            localStorage.setItem("musicVolume", volume);
        });

        if (localStorage.getItem("darkMode") === "true") {
            enableDarkMode();
        }

        darkModeOnBtn.addEventListener("click", enableDarkMode);
        darkModeOffBtn.addEventListener("click", disableDarkMode);

        function enableDarkMode() {
            settingsContainer.classList.remove("container-light");
            settingsContainer.classList.add("container-dark");
            document.body.classList.add("dark-mode");
            darkModeOnBtn.classList.add("bg-purple-600", "text-white", "button-active");
            darkModeOnBtn.classList.remove("bg-gray-200");
            darkModeOffBtn.classList.remove("bg-red-500", "text-white", "button-active");
            darkModeOffBtn.classList.add("bg-gray-200");
            localStorage.setItem("darkMode", "true");
        }

        function disableDarkMode() {
            settingsContainer.classList.remove("container-dark");
            settingsContainer.classList.add("container-light");
            document.body.classList.remove("dark-mode");
            darkModeOffBtn.classList.add("bg-red-500", "text-white", "button-active");
            darkModeOffBtn.classList.remove("bg-gray-200");
            darkModeOnBtn.classList.remove("bg-purple-600", "text-white", "button-active");
            darkModeOnBtn.classList.add("bg-gray-200");
            localStorage.setItem("darkMode", "false");
        }

        notificationsOnBtn.addEventListener("click", () => {
            notificationsOnBtn.classList.add("bg-green-500", "text-white", "button-active");
            notificationsOnBtn.classList.remove("bg-gray-200");
            notificationsOffBtn.classList.remove("bg-red-500", "text-white", "button-active");
            notificationsOffBtn.classList.add("bg-gray-200");
            localStorage.setItem("notifications", "true");
        });

        notificationsOffBtn.addEventListener("click", () => {
            notificationsOffBtn.classList.add("bg-red-500", "text-white", "button-active");
            notificationsOffBtn.classList.remove("bg-gray-200");
            notificationsOnBtn.classList.remove("bg-green-500", "text-white", "button-active");
            notificationsOnBtn.classList.add("bg-gray-200");
            localStorage.setItem("notifications", "false");
        });

        if (localStorage.getItem("notifications") === "false") {
            notificationsOffBtn.click();
        }
        
        function showSuccessModal() {
            successModal.classList.remove("hidden");
            const modalContent = successModal.querySelector("div:nth-child(2)");
            modalContent.classList.add("scale-100", "opacity-100");
            modalContent.classList.remove("scale-95", "opacity-0");
        }
        
        function closeSuccessModal() {
            const modalContent = successModal.querySelector("div:nth-child(2)");
            modalContent.classList.add("scale-95", "opacity-0");
            modalContent.classList.remove("scale-100", "opacity-100");
            setTimeout(() => {
                successModal.classList.add("hidden");
            }, 300);
        }

        document.querySelector(".w-full.mt-6.bg-gradient-to-r").addEventListener("click", function() {
            const textarea = document.querySelector("textarea");
            
            setTimeout(() => {
                if (textarea.value.trim() !== "") {
                    textarea.value = "";
                    showSuccessModal();
                } else {
                    alert("É necessário preencher o formulário para realizar o envio.");
                }
            }, 500);
        });
        
        document.getElementById("close-modal").addEventListener("click", closeSuccessModal);
        document.getElementById("confirm-modal").addEventListener("click", closeSuccessModal);
        
        successModal.addEventListener("click", function(e) {
            if (e.target === successModal) {
                closeSuccessModal();
            }
        });
        
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && !successModal.classList.contains("hidden")) {
                closeSuccessModal();
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const playAudio = () => {
                audio.play().then(() => {
                    console.log("Música tocando automaticamente 🎵");
                }).catch((error) => {
                    console.warn("Autoplay bloqueado! Esperando interação do usuário...");
                });
            };

            playAudio();

            document.addEventListener("click", playAudio, {
                once: true
            });
        });
    </script>
</body>

</html>