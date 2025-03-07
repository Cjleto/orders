<?php

namespace App\Helpers;

use Livewire\Component;

class LivewireSwal
{
    private const COMMON_PARAMS = [
        'position' => 'center',
        'toast' => false,
        'showConfirmButton' => true,
    ];

    private Component $component;

    public $params;

    public function __construct(Component $component)
    {
        $this->component = $component;
        $this->params = self::COMMON_PARAMS;
    }

    public static function make(Component $component): self
    {
        return new self($component);
    }

    public function success(): self
    {
        $localParams = [
            'title' => 'Successo!',
            'text' => 'Operazione completata con successo.',
            'type' => 'success',
            'confirmButtonText' => 'OK',
        ];

        $this->params = array_merge($this->params, $localParams);

        return $this;
    }

    public function error(): self
    {
        $localParams = [
            'title' => 'Errore!',
            'text' => 'Qualcosa è andato storto.',
            'type' => 'error',
            'confirmButtonText' => 'OK',
        ];

        $this->params = array_merge($this->params, $localParams);

        return $this;
    }

    public function warning(): self
    {
        $localParams = [
            'title' => 'Attenzione!',
            'text' => 'Attenzione!',
            'type' => 'warning',
            'confirmButtonText' => 'OK',
        ];

        $this->params = array_merge($this->params, $localParams);

        return $this;
    }

    public function info(): self
    {
        $localParams = [
            'title' => 'Informazione',
            'text' => 'Informazione',
            'type' => 'info',
            'confirmButtonText' => 'OK',
        ];

        $this->params = array_merge($this->params, $localParams);

        return $this;
    }

    public function confirm(): self
    {
        $localParams = [
            'title' => 'Sei sicuro?',
            'text' => 'Questa operazione non può essere annullata.',
            'type' => 'warning',
            'confirmButtonText' => 'Sì',
            'cancelButtonText' => 'Annulla',
            'emit' => 'confirmed',
        ];

        $this->params = array_merge($this->params, $localParams);

        return $this;
    }

    public function toast(): self
    {
        $localParams = [
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000,
        ];

        $this->params = array_merge($this->params, $localParams);

        return $this;
    }

    public function setParams($params): self
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    public function fireSwalEvent()
    {
        $this->component->dispatch('swal:modal', $this->params);
    }
}
