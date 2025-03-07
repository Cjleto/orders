<?php

use App\Mail\TestMail;

it('should send an email', function () {
    $this->withoutExceptionHandling();
    Mail::fake();
    Mail::to('letociccio@gmail.com')->send(new TestMail);
    Mail::assertSent(TestMail::class);
});
