<?php

namespace App\Services;

use App\Entities\Person;
use App\Repositories\PersonRepository;

class PersonService
{
    /** * @var \App\Repositories\PersonRepository */
    private $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function paginateAll(int $perPage = 15)
    {
        return $this->personRepository->paginate($perPage);
    }

    public function create(Person $person)
    {
        return $this->personRepository->createPerson($person);
    }

    public function getOne(string $id)
    {
        return $this->personRepository->find($id);
    }

    public function getPersonTree($parentId)
    {
        $persons = $this->personRepository->getPersonTreeByParentId($parentId);

        return $this->buildTree($persons, 'parent_id', $parentId, 'id');
    }

    private function buildTree(array $persons, string $pidKey, string $parentId, string $idKey = null)
    {
        $flat = json_decode(json_encode($persons), true);

        $grouped = array();
        foreach ($flat as $sub){
            if(isset($sub[$pidKey]))
                $grouped[$sub[$pidKey]][] = $sub;
        }

        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if(isset($grouped[$id])) {
                    $sibling['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }

            return $siblings;
        };

        $tree = [];

        if(isset($grouped[$parentId])) {
            $tree = $fnBuilder($grouped[$parentId]);
        }

        return $tree;
    }
}

