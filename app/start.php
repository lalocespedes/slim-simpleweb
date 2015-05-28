<?php

require '../vendor/autoload.php';

date_default_timezone_set('America/Mexico_City');

session_start();

$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig(),
    'templates.path' => '../app/templates'
));

$view = $app->view();

$view->parserOptions = array(
    'debug' => true
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

$app->get('/', function () use($app) {
    $app->render('home.twig');
})->name('home');

$app->get('/contact', function () use($app) {
    $app->render('contact.twig');
})->name('contact');

$app->post('/contact', function () use($app) {
    
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $msg = $app->request->post('msg');
  
  if(!empty($name) && !empty($email) && !empty($msg)) {
    $cleanName = filter_var($name, FILTER_SANITIZE_STRING);
    $cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $cleanMsg = filter_var($msg, FILTER_SANITIZE_STRING);
  } else {

    $app->flash('fail', 'All fields are required!');
    $app->redirect('/contact');
  }
  	
  	//send email with swift
    //$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
    //$emailer = \Swift_Mailer::newInstance($transport);
  
    //$message = \Swift_Message::newInstance();
    // $message->setSubject('Email from Our Website');
    // $message->setFrom(array(
    //   $cleanEmail => $cleanName
    // ));
    // $message->setTo(array('treehouse@localhost'));
    // $message->setBody($cleanMsg);
  
    // $result = $emailer->send($message);

  $result = true;
  
  if($result > 0) {
  	
  	$app->flash('success', 'Email send successfully!');

    $app->redirect('/');
    
  } else {
  
    $app->flash('fail', 'There was a error, try again!');
    $app->redirect('/contact');
  }
    
});


$app->run();