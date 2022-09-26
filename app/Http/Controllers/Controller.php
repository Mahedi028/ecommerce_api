<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="BdShop API",
 *         @OA\License(name="MIT")
 *     ),
 *     @OA\Server(
 *         description="API server",
 *         url="http://api.laravel-swagger-tutorial.test/",
 *     ),
 *     @OA\Server(
 *         description="development-server",
 *         url="http://localhost:8000/",
 *     ),
 * )
 */
class Controller extends BaseController
{

}
