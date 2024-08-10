<?php 

require __DIR__. '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost/mvc');

//Define o valor padrao das variaveis
View::initi([
    'URL' => URL
]);

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();



/* echo "<pre>";
print_r($obResponse);
echo "</pre>"; 
exit;*/
?>

