<?php
namespace App\Entities;

class Person
{
    
	/**
     * @var string
     */
    private $id;
	
    /**
     * @var string
     */
    private $fname;
	
	/**
     * @var string
     */
    private $lname;

    /**
     * @var int
     */
    private $parent_id;

    /**
     * @var int
     */
    private $birth_year;
	

    public function __construct(string $fname, string $lname,  string $birth_year, string $parent_id = null)
    {
        $this->fname = $fname;
        $this->parent_id = $parent_id;
        $this->lname = $lname;
        $this->birth_year = $birth_year;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }
	
	/**
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @return string
     */
    public function getBirthYear()
    {
        return $this->birth_year;
    }
}

