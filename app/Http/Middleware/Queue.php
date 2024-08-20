<?php 
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
}

?>