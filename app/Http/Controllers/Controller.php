<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="BdShop",
 *         @OA\License(name="MIT")
 *     ),
 *     @OA\Server(
 *         description="Api server",
 *         url="petstore.swagger.io",
 *     ),
 *     @OA\Server(
 *         description="Development-server",
 *         url="http://localhost:8000/api/v1",
 *     ),
 * )
 */


class Controller extends BaseController
{

}
