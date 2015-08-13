<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 8/13/15
 * Time: 1:01 PM
 */

namespace Contact\Controllers;


use Contact\Models\Contact;

class ContactController {

    private $contact;

    /*
     * Initialize the ContactController.
     * Inject the Contact model into the controller
     * as a dependency.
     * @param $contact
     */
    public function __construct(Contact $contact) {
        $this->contact = $contact;
    }


    /*
     * create a new contact in database
     *the parameters are sent in from the
     * server request.
     * @param $first
     * @param $last
     * @param $mid [optional]
     * @param $last
     * @param $email
     * @param $phone
     */

    public function createContact($first, $last, $mid = null, $last,
                                  $email, $phone) {

        $this->contact->setEmail($email);
        $this->contact->setFirstName($first);
        $this->contact->setLastName($last);
        $this->contact->setPhone($phone);
        $this->contact->setMiddleName($mid);

        $this->contact->save();
    }
}