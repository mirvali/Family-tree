<?php namespace App\Http\Controllers;

use App\Entities\Person;
use App\Services\PersonService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PersonController extends Controller {

    //const MODEL = "App\Person";
    //use RESTActions;
    
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }
    
    public function getPersons(){
         $persons = $this->personService->paginateAll(15);
         return response()->json($persons, Response::HTTP_OK);
    }
    
    public function getPerson($id){
        $person = $this->personService->getOne($id);
        return response()->json($person, Response::HTTP_OK);
    }
    
    public function addPerson(Request $request){

        $this->validate($request, [
            'fname'      => 'required',
            'birth_year' => 'required|integer',
        ]);

        $person = new Person($request->input('fname'),
			     $request->input('lname'),
			     $request->input('birth_year'),
			     $request->input('parent_id'));

        $addedPerson = $this->personService->create($person);

        if($addedPerson) {
            return response()
                ->json(['created' => 'success'], Response::HTTP_CREATED);
        } else {
            return response()
                ->json(['created' => 'error'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    
    public function updatePerson($id, Request $request){}
    
    public function getPersonFamilyTree($parentId){
         $person = $this->personService->getPersonTree($parentId);
         return response()->json($person, Response::HTTP_OK);
    }

}
