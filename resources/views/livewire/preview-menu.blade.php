<div class="container-fluid ciao">
    <style id="pulic-menu-style">
        :root {
            --base-font-size: 16px;
            --smaller-font-size: calc(var(--base-font-size) - 2px);
            /* valore di default */
        }

        body {
            font-size: var(--base-font-size);
        }

        .menu-container {
            background-color: rgba(0, 0, 0, 0.6);
            /* Sfondo semi-trasparente */
            padding: 20px;
            border-radius: 10px;
            /* font-family: Arial, sans-serif; */
            /* background-image: url('https://fastly.picsum.photos/id/835/600/600.jpg?hmac=ExJqcXeiqUZH7eZOGz7KHVJNCIvj9ne1jACoQFk7dsE'); /* Sostituisci con il link dell'immagine */
            background-size: cover;
            background-position: center;

            padding: 20px;

            position: relative;
            /* Necessario per posizionare l'immagine di sfondo */
            overflow: hidden;
            /* Assicura che l'immagine non fuoriesca dal contenitore */

            background-color: #fff !important;
        }


        .content {
            position: relative;
            /* Mantiene il contenuto sopra l'immagine */
            z-index: 1;
            /* Assicura che il contenuto sia sopra l'immagine di sfondo */
        }

        .font-smaller {
            font-size: var(--smaller-font-size);
        }

        .font-bigger {
            font-size: calc(var(--base-font-size) + 2px);
        }
        body {
            background-color: {{ \Route::current()->getName() == 'public.menu' ? $this->menuSetting->background_color : '' }}
        }

        .menu-container{
            background-color: {{ \Route::current()->getName() != 'public.menu' ? $this->menuSetting->background_color : '' }} !important;
        }
    </style>
    {{-- <div style="height: calc(100vh - 50px); overflow: auto;" class="border shadow-lg border-1 rounded-2 border-primary"> --}}
    {{-- <div style="" class="border shadow-lg border-1 rounded-2 border-primary">

        <div x-data="{ template: '{{ $selectedTemplate }}' }" @template-changed.window="template = $event.detail; console.log($event.detail[0])">
            <div class="menu-preview">
                <!-- Usa Livewire per includere dinamicamente il template -->

                <div x-show="template == 'template1'">
                    @include('menu_templates.template1')
                </div>

                <div x-show="template == 'template2'">
                    @include('menu_templates.template2')
                </div>

                <!-- Aggiungi altri template come necessario -->
            </div>
        </div>

    </div> --}}

    <div class="menu-preview">

        @include('menu_templates.' . $selectedTemplate)

    </div>


</div>
