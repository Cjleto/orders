<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invia una mail di test all\'indirizzo specificato';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Inserisci l\'indirizzo email a cui inviare la mail di test');
        $this->info("Invio della mail di test all'indirizzo $email in corso...");
        // Invia la mail di test
        Mail::to($email)->send(new TestMail());
        $this->info('Mail di test inviata con successo!');

        return 0;
    }
}
