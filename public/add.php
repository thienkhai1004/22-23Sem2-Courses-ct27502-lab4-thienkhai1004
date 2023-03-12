<?php
require_once '../bootstrap.php';

use CT275\Labs\Contact;

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
      $contact = new Contact($PDO);
      $contact->fill($_POST);
      if($contact->validate())
      {
            $contact->save() && redirect('/lab4/public/index.php');
      }
      $errors = $contact->getValidationErrores();
}