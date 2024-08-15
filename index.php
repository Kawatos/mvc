<?php 
require __DIR__.'/includes/app.php';
use \App\Http\Router;



$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();



/* echo "<pre>";
print_r($obResponse);
echo "</pre>"; 
exit;*/
?>

