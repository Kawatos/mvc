<?php 


use \App\Http\Response;
use \App\Controller\Pages;

// Rota Home
$obRouter->get('/',[
    function(){
        return new Response(200,Pages\Home::getHome());
    }
]);
// Rota Sobre
$obRouter->get('/sobre',[
    function(){
        return new Response(200,Pages\About::getAbout());
    }
]);

$obRouter->get('/depoimentos',[
    function(){
        return new Response(200,Pages\Testimony::getTestimonies());
    }
]);

$obRouter->post('/depoimentos',[
    function($request){
        echo "<pre>";
        print_r($request);
        echo "</pre>"; exit;
        
        return new Response(200,Pages\Testimony::insertTestimony($request));
    }
]);

/* //rota dinamica
$obRouter->get('/pagina/{idPagina}/{acao}',[
    function($idPagina, $acao){
        return new Response(200, 'Pagina ' . $idPagina. ' - ' . $acao);
    }
]); */
?>