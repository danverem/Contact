<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 8/13/15
 * Time: 10:51 AM
 */
namespace Contact\Models;

use Contact\Util\DbConnect;

class Contact {


    private $firstName;
    private $lastName;
    private $middleName;
    private $phoneNumber;
    private $emailAddress;
    private $group;
    private $db;
    private $tone;


    public function __construct($first, $last, $phone, Group $group = null, Tone $tone) {
        $this->firstName = $first;
        $this->lastName = $last;
        $this->phoneNumber = $this->setPhone($phone);
        $this->group = $group;
        $this->tone = $tone;
    }
    /*
     * Set the first name of the user.
     * @param $first
     */
    public function setFirstName($first) {
        $this->firstName = $first;

    }

    /*
     * Returns the contact's first name;
     * @return firstName
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /*
     * Set the middle name of the user.
     * @param $middle
     */
    public function setMiddleName($middle) {
        $this->middleName = $middle;
    }

    /*
     * Return the middle name of the user.
     * @return middleName
     */
    public function getMiddleName(){
        return $this->middleName;
    }

    /*
     * Set the last name of the contact
     * @param $last
     */
    public function setLastName($last) {
        $this->lastName =$last;
    }

    /*
     * Returns the last name of the contact
     * @return lastName
     */
    public function getLastName() {
        return $this->lastName;
    }

    /*
     * Sets the user email, returns true if the user email is valid,
     * and false if it isn't.
     */
    public function setEmail($email) {
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);
        if($isValid) {
            $this->emailAddress = $email;
        }else {
            return false;
        }
    }


    /*
     * Return the user email to the caller
     */
    public function getEmail() {
        return $this->emailAddress;
    }

    /*
     * Attempts to validate the contact phone number.
     * returns false if the number is invalid as per
     * regex specifications.
     *
     * @param $phone
     */
    public function setPhone($phone) {
        $isValid = ereg('^[0-9][0-9]+[0-9]$', $phone);
        if($isValid) {
            $this->phoneNumber = $phone;
        }else {
            return false;
        }
    }

    /*
     * Return the phone number of the contact
     * @return phoneNumber
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    public function setTone($tone) {
        $this->tone = $tone;
    }

    public function getTone() {
        return $this->tone;
    }

    public function save(){
        $this->db = new DbConnect('localhost', 'contact','', 'root');

        //prepare a sql statement
        $link = $this->db->getConnection();
        $stmt = $link->prepare("INSERT INTO contacts(first_name, last_name,others, phone_number, email, tone_id) VALUES(?,?,?,?,?,?)");

        //bind parameters
        $stmt->bind_param("sssssi",
            $this->getFirstName(), $this->getLastName(), $this->getMiddleName(),
                $this->getPhoneNumber(), $this->getEmail(), $this->getTone());


        //execute the statement.
        $stmt->execute();

        $stmt->close();
        $this->db->closeConnection($link);
    }


    public function deleteContact($id) {
        $this->db = new DbConnect('localhost', 'contact','', 'root');
        $link = $this->db->getConnection();

        //prepare statement
        $preparedStatement = $link->prepare("DELETE FROM contacts WHERE contact_id = ?");

        //bind parameters
        $preparedStatement->bind_param('i', $id);

        //execute the statement
        $preparedStatement->execute();

        //close the statment
        $preparedStatement->close();

        //close the connection
        $this->db->closeConnection($link);
    }


    public function findContactById($id) {
        $this->db = new DbConnect('localhost', 'contact','', 'root');
        $link = $this->db->getConnection();

        //prepare statement
        $preparedStatement = $link->prepare("SELECT * FROM contacts WHERE contact_id = ?");

        //bind parameters
        $preparedStatement->bind_param('i', $id);

        //execute the statement
        $preparedStatement->execute();

        //close the statement
        $preparedStatement->close();

        //close the connection
        $this->db->closeConnection($link);
    }

    public function updateContact( Contact $contact) {
        
    }

}