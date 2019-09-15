<?php

namespace App\Repositories; 

use App\Person; 
use App\Repositories\Infrastructure\Contracts\AbstractRepository; 
use Illuminate\Support\Facades\DB; 

class PersonRepository extends AbstractRepository {
    /**
     * @return string
     */
    public function getModel(): string
    {
        return 'App\Person';
    }

    public function createPerson(\App\Entities\Person $person)
    {
        return $this->create($this->toArray($person));
    }

    private function toArray(\App\Entities\Person $person): array
    {
        return [
            'fname' => $person->getFname(),
            'lname' => $person->getLname(),
            'parent_id' => $person->getParentId(),
            'birth_year' => $person->getBirthYear()
        ];
    }
    public function getPersonTreeByParentId($parentId)
    {
        $results = DB::select( "select id,
                fname,
                parent_id
            from (select * from person
                     order by parent_id, id) persons_sorted,
                    (select @pv := '$parentId') initialisation
            where find_in_set(parent_id, @pv)
            and length(@pv := concat(@pv, ',', id));");
        return $results;
    }
}
