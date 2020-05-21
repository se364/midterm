<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('vendor/autoload.php');

//F3 class
$f3 = Base::instance();


// Define a default route
$f3->route('GET /', function(){
    //echo '<h1> Pet Home</h1>';
    $view = new Template();
    echo $view->render('views/home.html');
}
);
$f3->route('GET|POST /survey', function ($f3) {
    //echo "<h1>Hello World!</h1>";

    // Check if teh form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // validate the data
        if (empty($_POST['pet'])) {
            //Validate the data
            echo 'Please supply a pet type';

        } else {
//        echo "get method";
            //Data is valid
            $_SESSION['pet'] = $_POST['pet'];

            //Added color to the session
            $_SESSION['color'] = $_POST['color'];
//            $_SESSION['pet'] = $_POST['pet'];
//            $_SESSION['pet'] = $_POST['pet'];
//            $_SESSION['pet'] = $_POST['pet'];

            //Redirect to the summary route
            $f3->reroute('summary');
        }
    }
   // $f3->set('pet', $pet);
    $view = new Template();
    echo $view->render("views/survey.html");
}
);

$f3->route('GET /summary', function() {
    //echo '<h1>Thank you for your order!</h1>';

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

$f3->run();



