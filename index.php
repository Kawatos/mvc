<?php 
require __DIR__.'/includes/app.php';

use \App\Http\Router;

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

// Rotas do painel do administrador
include __DIR__.'/routes/admin.php';

// Rotas da pagina
$obRouter->run()->sendResponse();

/* echo "<pre>";
print_r($obResponse);
echo "</pre>"; 
exit;*/
?>

