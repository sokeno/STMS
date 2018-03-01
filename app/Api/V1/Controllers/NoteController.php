<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\HttpException;
//use Tymon\JWTAuth\JWTAuth;
//use Tymon\JWTAuth\Facades\JWTAuth;
use JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use App\Note;
use Dingo\Api\Routing\Helpers;

class NoteController extends Controller
{
    //
    use Helpers;

    public function index()
{
    $currentUser = JWTAuth::parseToken()->authenticate();
    return $currentUser
        ->notes()
        ->orderBy('id', 'DESC')
        ->get()
        ->toArray();
}
public function store(Request $request)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $note = new Note;

    $note->task_id = $request->get('task_id');
    $note->description = $request->get('description');
   

    if($note->save())
        return $this->response->created();
    else
        return $this->response->error('could_not_create_note', 500);
}

public function show($id)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $note = $currentUser->notes()->find($id);

    if(!$note)
        throw new NotFoundHttpException; 

    return $note;
}

public function update(Request $request, $id)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $note = $currentUser->notes()->find($id);
    if(!$note)
        throw new NotFoundHttpException;

    $note->fill($request->all());

    if($note->save())
        return $this->response->noContent();
    else
        return $this->response->error('could_not_update_note', 500);
}

public function destroy($id)
{
    $currentUser = JWTAuth::parseToken()->authenticate();

    $note = $currentUser->notes()->find($id);

    if(!$note)
        throw new NotFoundHttpException;

    if($note->delete())
        return $this->response->noContent();
    else
        return $this->response->error('could_not_delete_note', 500);
}

}
