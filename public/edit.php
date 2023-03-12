<?php
require_once '../bootstrap.php';

use CT275\Labs\Contact;

$contact = new Contact($PDO);
$id = isset($_REQUEST['id']) 
      ? filter_var($_REQUEST['id'],
       FILTER_SANITIZE_NUMBER_INT) 
      : -1;
if($id < 0 || !($contact->find($id)))
{
      redirect('/lab4/public/index.php');
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
      if($contact->update($_POST))
      {
            redirect('/lab4/public/index.php');
      }
      $errors = $contact->getValidationErrores();
}