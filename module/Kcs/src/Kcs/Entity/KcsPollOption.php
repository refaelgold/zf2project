<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/26/13
 * Time: 5:57 PM
 */

namespace Website\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class KcsPollOption {


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;



    /** @ORM\Column(type="string") */
    protected $FullName;


    /** @ORM\Column(type="string") */
    protected $PhoneNumber;


    /** @ORM\Column(type="text") */
    protected $Message;

    /** @ORM\Column(type="text") */
    protected $Email;




    protected  $contactUs;
    public function _construct(){

        //Initializing collection. Doctrine recognizes Collections, not arrays!
        $this->contactUs = new ArrayCollection();
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





    public function getId()
    {
        return $this->id;
    }





    public function setMessage($value)
    {
        $this->Message = $value;
    }

    public function getMessage()
    {
        return $this->Message;
    }





    public function setPhoneNumber($value)
    {
        $this->PhoneNumber = $value;
    }

    public function getPhoneNumber()
    {
        return $this->PhoneNumber;
    }




    public function setFullName($value)
    {
        $this->FullName = $value;
    }

    public function getFullName()
    {
        return $this->FullName;
    }

    public function setEmail($value)
    {
        $this->Email = $value;
    }

    public function getEmail()
    {
        return $this->Email;
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