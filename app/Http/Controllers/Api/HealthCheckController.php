<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends Controller
{
    public function checkHealthRedis()
    {
        $redis = Redis::connection('default');
        $redis->connect();
        $redis->disconnect();

        echo 'Redis working';
    }

    public function checkDBConnect()
    {
        DB::connection('pgsql')->getPdo();

        if (DB::connection('pgsql')->getDatabaseName()) {
            echo 'Connect DB Success';
        }
    }
}
