<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 8/13/15
 * Time: 11:48 AM
 */
namespace Contact\Models;

class Group {


    private $groupName;
    private $tone;

    /*
     * Instantiate the class
     * @param $name
     * @param $tone
     */
    public function __construct($name, Tone $tone) {

        $this->groupName = $name;
        $this->tone = $tone;
    }

    /*
     * Set the tone of for the group
     * @param $tone
     */
    public function setTone($tone) {
        $this->tone = $tone;
    }

    /*
     * return the tone for the group
     * @return $tone
     */
    public function  getTone() {
        return $this->tone;
    }

    /*
     * set the name for the group
     * @param $name
     */
    public function setName($name) {
        $this->groupName = $name;
    }

    /*
     * return the name of the group
     * @return $groupName
     */
    public function getName() {
        return $this->groupName;
    }
}