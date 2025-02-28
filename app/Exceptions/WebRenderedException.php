<?php

namespace App\Exceptions;

use Exception;

class WebRenderedException extends Exception
{


    public function render()
    {


        return response()->view('errors.web-rendered', [
            'main_text' => $this->message,
            'secondary_text' => 'Contattare l\'amministratore di sistema',
        ], 400);
    }
}
