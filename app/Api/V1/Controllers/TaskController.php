<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\HttpException;
//use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
//use JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use App\Task;
use Dingo\Api\Routing\Helpers;

class TaskController extends Controller
{
    //
    use Helpers;

    public function index()
{
    $currentUser = JWTAuth::parseToken()->authenticate();
    return $currentUser
        ->tasks()
        ->orderBy('start_time', 'DESC')
        ->get()
        ->toArray();
}
public function store(Request $request)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $task = new Task;

    $task->name = $request->get('name');
    $task->start_time = $request->get('start_time');
    $task->end_time = $request->get('end_time');

    if($currentUser->tasks()->save($task))
        return $this->response->created();
    else
        return $this->response->error('could_not_create_task', 500);
}

public function show($id)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $task = $currentUser->tasks()->find($id);

    if(!$task)
        throw new NotFoundHttpException; 

    return $task;
}

public function update(Request $request, $id)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $task = $currentUser->tasks()->find($id);
    if(!$task)
        throw new NotFoundHttpException;

    $task->fill($request->all());

    if($task->save())
        return $this->response->noContent();
    else
        return $this->response->error('could_not_update_task', 500);
}

public function destroy($id)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $task = $currentUser->tasks()->find($id);

    if(!$task)
        throw new NotFoundHttpException;

    if($task->delete())
        return $this->response->noContent();
    else
        return $this->response->error('could_not_delete_task', 500);
}

}
