<?php

declare(strict_types=1);

it('does not use any forbidden functions')
    ->expect(['dump', 'dd', 'die', 'var_dump', 'debug', 'ray'])
    ->not->toBeUsed();
