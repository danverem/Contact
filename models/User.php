<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 8/13/15
 * Time: 11:36 AM
 */
namespace Contact\Models;

class User {

    /*
     * Private instance variables for the user.
     * variables must be provided at instantiation
     * time.
     */

    private $username;
    private $password;
    private $email;

    /*
     * Initialize the class wit the constructor.
     * @param $name
     * @param $pass
     * @param $email
     */
    public function __construct($name, $pass, $email) {
        $this->email = $this->setEmail($email);
        $this->password = $pass;
        $this->username = $this->setUsername($name);
    }

    /*
     * Attempts to validate the username before setting
     * it. returns false if validation fails
     * @param $name
     */
    public function setUsername($name) {
        $isValid = ereg('^[a-zA-Z][a-z]+[0-9]*',$name);
        if($isValid) {
            $this->username = $name;
        }else{
            return false;
        }
    }

    /*
     * Return the username of the user
     * @return $username
     */
    public function getUsername() {
        return $this->username;
    }

    /*
     * Validate the email address before setting it.
     * Return false if email is not valid.
     * @param $email.
     */
    public function setEmail($email) {
        $isValid= filter_var($email, FILTER_VALIDATE_EMAIL);
        if($isValid) {
            $this->email = $email;
        }else{
            return false;
        }
    }

    /*
     * Return the user email
     * @return $email
     */
    public function getEmail() {
        return $this->email;
    }

}