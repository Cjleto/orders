<div class="p-0 container-xl p-md-3" style="font-family: {{ $selectedFont }}" {{-- wire:poll.keep-alive.15s="refreshMenu" --}}>
    <style>
        :root {
            --base-font-size: 16px;
            --smaller-font-size: calc(var(--base-font-size) - 4px);
            /* valore di default */
        }

        body {
            font-size: var(--base-font-size);
        }

        .font-smaller {
            font-size: var(--smaller-font-size);
        }

        .font-bigger {
            font-size: calc(var(--base-font-size) + 4px);
        }

        body {
            background-color: {{ \Route::current()->getName() == 'public.menu' ? $this->menuSetting->background_color : '' }}
        }

        .menu-container {
            background-color: {{ \Route::current()->getName() != 'public.menu' ? $this->menuSetting->background_color : '' }} !important;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;


        }

        .splash-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: {{ \Route::current()->getName() == 'public.menu' ? $this->menuSetting->background_color : '' }};
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            opacity: 1;
            /* Visibile all'inizio */
            //animation: fadeIn 1.5s ease-out forwards; /* Animazione di ingresso */
        }

        .splash-screen.hidden {
            animation: fadeOut 1.5s ease-out forwards;
            /* Animazione di uscita */
        }

        .main-content {
            display: none;
            /* Nascondi il contenuto principale inizialmente */
            opacity: 0;
            /* Nascondi inizialmente */
            animation: fadeIn 1.5s ease-out forwards;
            /* Animazione di ingresso */
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.9);
            }
        }
    </style>

    {{-- <div style="height: calc(100vh - 50px); overflow: auto;" class="border shadow-lg border-1 rounded-2 border-primary"> --}}

    <div class="splash-screen" id="splash">
        <!-- Il logo o il contenuto dello splash screen -->
        <img src="{{ $this->logoSplash }}" alt="Logo" style="width: 150px; height: auto;">
    </div>

    <div class="p-0 container-fluid" id="content">
        @include("menu_templates.$template")
    </div>

    @if (\Route::current()->getName() == 'public.menu')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const splash = document.getElementById("splash");
                const content = document.getElementById("content");

                // Mostra il contenuto principale dopo l'animazione di uscita dello splash screen
                setTimeout(() => {
                    splash.classList.add("hidden"); // Applica la classe per l'animazione di uscita

                    // Mostra il contenuto principale dopo l'uscita dello splash screen
                    splash.addEventListener("animationend", () => {
                        splash.style.display = "none"; // Nascondi completamente lo splash screen
                        content.style.display = "block"; // Mostra il contenuto principale
                    });
                }, 2500); // Tempo di attesa prima dell'uscita (in ms)
            });
        </script>
    @endif
</div>
