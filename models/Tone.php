<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 8/13/15
 * Time: 11:46 AM
 */
namespace Contact\Models;

class Tone {


    private $tone;

    public function __construct($tone) {
        $this->tone = $tone;
    }


    public function setTone($tone) {
        $this->tone = $tone;
    }

    public function getTone() {
        return $this->tone;
    }
}