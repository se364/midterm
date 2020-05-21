<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('vendor/autoload.php');
require_once("model/data-layer.php");

//F3 class
$f3 = Base::instance();


// Define a default route
$f3->route('GET /', function(){
    //echo '<h1> Pet Home</h1>';
    $view = new Template();
    echo $view->render('views/home.html');
}
);
$f3->route('GET|POST /survey', function($f3) {

    $conds = getOption();

    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Store the data in the session array
        $_SESSION['conds'] = $_POST['conds'];

        //Redirect to summary page
        $f3->reroute('summary');
    }

    $f3->set('conds', $conds);
    $view = new Template();
    echo $view->render('views/survey.html');
});

$f3->route('GET /summary', function() {
    //echo '<h1>Thank you for your order!</h1>';

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

$f3->run();



