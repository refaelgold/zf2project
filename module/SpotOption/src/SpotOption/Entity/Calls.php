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
class Calls {



    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $Content;


    /** @ORM\Column(type="text") */
    protected $Subject;


    /** @ORM\Column(type="text") */
    protected $CustomerId;







    protected  $call;
    public function _construct(){

        //Initializing collection. Doctrine recognizes Collections, not arrays!
        $this->call = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }



    public function populate(array $data = array())
    {
        foreach ($data as $property => $value) {
            if (! property_exists($this, $property)) {
                continue;
            }
            $this->$property = $value;
        }
    }





    public function setCustomerId($value)
    {
        $this->CustomerId = $value;
    }

    public function getCustomerId()
    {
        return $this->CustomerId;
    }





    public function setSubject($value)
    {
        $this->Subject = $value;
    }

    public function getSubject()
    {
        return $this->Subject;
    }


    public function setContent($value)
    {
        $this->Content = $value;
    }

    public function getContent()
    {
        return $this->Content;
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