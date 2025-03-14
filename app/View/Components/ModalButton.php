<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalButton extends Component
{
    public function __construct(
        public string $modalId,
        public string $class,
        public string $modalTitle,
        public ?string $modalClass,
        public ?string $modalDialog,
        public string $icon,
        public string $body = '',
        public string $footerClass = '',
        public string $saveText = 'Save changes')
    {
        $this->modalId = $modalId;
        $this->class = $class;
        $this->modalTitle = $modalTitle;
        $this->modalClass = $modalClass;
        $this->modalDialog = $modalDialog;
        $this->icon = $icon;
        $this->body = $body;
        $this->footerClass = $footerClass;
        $this->saveText = $saveText;
    }

    public function render()
    {
        return view('components.modal-button');
    }
}
