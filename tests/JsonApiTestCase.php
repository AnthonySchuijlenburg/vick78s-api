<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use LaravelJsonApi\Testing\MakesJsonApiRequests;

abstract class JsonApiTestCase extends BaseTestCase
{
    use MakesJsonApiRequests;
    use RefreshDatabase;
}
