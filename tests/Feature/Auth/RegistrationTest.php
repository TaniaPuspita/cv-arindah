<?php

test('registration page is unavailable', function () {
    $this->get('/register')->assertNotFound();
});
