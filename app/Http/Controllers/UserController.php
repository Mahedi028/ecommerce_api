<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use OpenApi\Annotations as OA;
use PDOException;


class UserController extends Controller
{
       /**
     * @OA\Get(
     *     path="/users",
     *     operationId="index",
     *     tags={"User"},
     *     summary="Returns all users list",
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="full_name", type="string", example="Anik Ahamed"),
     *             @OA\Property(property="username", type="string", example="anik023"),
     *             @OA\Property(property="email", type="string", example="anik023@gmail.com"),
     *             @OA\Property(property="password", type="string", example="dkakdnahwhheohwhdhsb"),
     *             @OA\Property(property="status", type="number", example=1),
     *         )
     *     )
     * )
     */

    //get API:http://localhost:8000/api/v1/users/
     public function index()
     {

        try{
            $user_data=app('db')->table('users')->get();
            return response()->json([
                'status'=>true,
                'message'=>'User fetched successfull',
                'data'=>$user_data,
                'errors'=>null
            ],201);
        }catch(\PDOException $e){
            return response()->json([
                'status'=>false,
                'message'=>'Something went wrong',
                'data'=>null,
                'errors'=>$e->getMessage()
            ],400);
        }
     }



     public function create(Request $request)
     {
        /**
 * @OA\Post(
 *   path="/users",
 *   operationId="create",
 *   summary="Create an user",
 *   description="Create an new user",
 *   tags={"User"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\MediaType(
 *       mediaType="application/json",
 *       @OA\Schema(
 *         required={"content"},
 *         @OA\Property(
 *           description="Binary content of file",
 *           property="content",
 *           type="string",
 *           format="binary"
 *         )
 *       )
 *     )
 *   ),
 *   @OA\Response(
 *     response=200, description="Success",
 *     @OA\JsonContent(
 *          @OA\Property(property="id", type="number", example=1),
  *             @OA\Property(property="status", type="boolean", example="true"),
     *          @OA\Property(property="message", type="string", example="User created successfull"),
     *          @OA\Property(property="data", type="string", example="anik023@gmail.com"),
     *          @OA\Property(property="errors", type="null"),
     *         )
 *   ),
 *   @OA\Response(
 *     response=400, description="Bad Request"
 *   )
 * )
 */


        try{
            $this->validate($request,[
                'full_name'=>['required'],
                'username'=>['required'],
                'email'=>['required'],
                'password'=>['required'],
                'status'=>['required']
            ]);

        }catch(ValidationException $e){
            return response()->json([
                    'status'=>false,
                    'message'=>'',
                    'data'=>null,
                    'errors'=>$e->getMessage()
                ],422);
        }


        try{
            $id=app('db')->table('users')->insert([
                'full_name'=>trim($request->input('full_name')),
                'username'=>strtolower(trim($request->input('username'))),
                'email'=>strtolower(trim($request->input('email'))),
                'password'=>app('hash')->make($request->input('password')),
                'status'=>$request->input('status'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);

            $user=app('db')->table('users')->select('full_name', 'username', 'email')->where('id', $id)->first();

            return response()->json([
                'status'=>true,
                'message'=>'User added successfull',
                'data'=>$user,
                'errors'=>null
            ],201);


        }catch(\PDOException $e){
            return response()->json([
                'status'=>false,
                'message'=>'',
                'data'=>null,
                'errors'=>$e->getMessage()
            ],400);
        }
     }

     public function update(Request $request, $id)
     {
        /**
         * @OA\Put(
         *     path="/users/{id}",
         *     tags={"User"},
         *     summary="Update User data",
         *     operationId="update",
         *     description="Update existing user data",
         *     @OA\Parameter(
         *         name="id",
         *         description="ID user",
         *         in="path",
         *         @OA\Schema(
         *             type="string"
         *         )
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="successfull operation",
         *     ),
         *     @OA\Response(
         *         response=400,
         *         description="Error validation",
         *     ),
         * )
         */
     }


     public function authenticate(Request $request)
     {
        //validation
        try{
            $this->validate($request,[
                'email'=>['required'],
                'password'=>['required']
            ]);

        }catch(ValidationException $e){
            return response()->json([
                    'status'=>false,
                    'message'=>'',
                    'data'=>null,
                    'errors'=>$e->getMessage()
                ],422);
        }

        $token=app('auth')->attempt($request->only('email', 'password'));

        if($token){
            return response()->json([
                'status'=>true,
                'message'=>'User authenticated',
                'token'=>$token,
                'errors'=>null
            ],201);
        }

        return response()->json([
            'status'=>false,
            'message'=>'Invalid credentials',
            'data'=>null,
            'errors'=>$e->getMessage()
        ],422);





     }

}
