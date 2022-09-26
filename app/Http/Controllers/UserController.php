<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
   /**
     * @OA\Get(
     *     path="/users",
     *     summary="List all users",
     *     operationId="index",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="include",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                 type="string",
     *                 enum = {"user"},
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="An paged array of posts",
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *     )
     * )
     */

     public function index()
     {

     }
}
