<?php 

namespace App\Http\Middleware;

class Queue{
    /**
     * Fila de middlewares a serem executados
     * 
     * @var array
     */
    private $middlewares = [];

    /**
     * funcao de execucao do controlador
     * @var Closure
     */
    private $controller;
    /**
     * Argumentos da funcao do controlador
     *
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Metodo responsavel por construir a classe
     *
     * @param array $middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     */
    public function __construct($middlewares, $controller,$controllerArgs) {
        $this->middlewares = $middlewares;
        $this->controller =  $controller;
        $this->controllerArgs = $controllerArgs;
        
    }

    /**
     * Metodo responsavel por executar o proximo nivel da fila de middlewares
     *
     * @param Request $request
     * @return Response
     */

    public function next($request){
        echo "<pre>";
        print_r($this);
        echo "</pre>"; exit;
    }
}

?>