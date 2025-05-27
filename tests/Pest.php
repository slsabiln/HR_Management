<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Pest\Laravel;

uses(Tests\CreatesApplication::class)->in(__DIR__);
uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature', 'Unit');
