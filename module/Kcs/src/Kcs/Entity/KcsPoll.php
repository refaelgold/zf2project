<?php
/**
 * Created by PhpStorm.
 * User: refaelgold
 * Date: 11/26/13
 * Time: 5:57 PM
 */

namespace Kcs\Entity;
use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class KcsPoll {


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;


    /** @ORM\Column(type="string") */
    protected $title;



    protected  $KcsPoll;
    public function _construct(){

        //Initializing collection. Doctrine recognizes Collections, not arrays!
        $this->KcsPoll = new ArrayCollection();
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





    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
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