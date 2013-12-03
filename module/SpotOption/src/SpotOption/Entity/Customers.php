<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/26/13
 * Time: 5:57 PM
 */


namespace SpotOption\Entity;

use Doctrine\ORM\Mapping as ORM;







/** @ORM\Entity */
class Customers {



    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $FirstName;



    /** @ORM\Column(type="string") */
    protected $LastName;


    /** @ORM\Column(type="string") */
    protected $Phone;


    /** @ORM\Column(type="string") */
    protected $Address;


    /** @ORM\Column(type="integer") */
    protected $Status;


//
//    public function getArrayCopy()
//    {
//        return get_object_vars($this);
//    }




    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate(array $data = array())
    {
        foreach ($data as $property => $value) {
            if (! property_exists($this, $property)) {
                continue;
            }
            $this->$property = $value;
        }
    }


//
//
//
//
//    protected  $customer;
//    public function _construct(){
//
//        //Initializing collection. Doctrine recognizes Collections, not arrays!
//        $this->customer = new ArrayCollection();
//    }
//



    public function getId()
    {
        return $this->id;
    }





    public function setFirstName($value)
    {
        $this->FirstName = $value;
    }

    public function getFirstName()
    {
        return $this->FirstName;
    }




    public function setLastName($value)
    {
        $this->LastName = $value;
    }

    public function getLastName()
    {
        return $this->LastName;
    }


    public function setPhone($value)
    {
        $this->Phone = $value;
    }

    public function getPhone()
    {
        return $this->Phone;
    }


    public function setAddress($value)
    {
        $this->Address = $value;
    }

    public function getAddress()
    {
        return $this->Address;
    }


    public function setStatus($value)
    {
        $this->Status = $value;
    }

    public function getStatus()
    {
        return $this->Status;
    }



    /**
     * Get an array copy of object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }



}