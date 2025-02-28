@props(['class' => ''])

{{-- <div  >
    Questo è un prodotto creato da menulight
</div> --}}


<div {{ $attributes->merge(['class' => 'text-center ' . $class]) }} style="width: 18rem;">
    <div class="">
        {{-- <img src="{{ asset('img/logo.png') }}" alt="logo" class="text-center img-fluid w-75" > --}}
        <p class="text-center">Powered by <a href="http://menulight.it">menulight</a></p>
    </div>
</div>
