<?php

namespace Mi\L5Swagger\Http\Controllers;

use App\Http\Controllers\Controller;
use Mi\L5Swagger\Generator;

class SwaggerJsonController extends Controller
{
    public function index(Generator $generator, $site)
    {
        return response()->success($generator->handle('api/' . $site));
    }

    public function demoSwagger()
    {
        return ['demoSwagger success'];
    }
}
