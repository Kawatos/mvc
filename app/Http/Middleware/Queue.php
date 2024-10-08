<?php 

namespace App\Http\Middleware;

class Queue{

    /**
     * Mapa dos middlewares para execucao
     *
     * @var array
     */
    private static $map = [];

    /**
     * mapeamento de middlewares que serao carregados em todas as rotas
     * @var array
     */

    private static $default = [];

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
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller =  $controller;
        $this->controllerArgs = $controllerArgs;
        
    }

    /**
     * Metodo responsavel por definir o mapeamento de middlewares
     *
     * @param array $map
     */
    public static function setMap($map){
        self::$map = $map;
    }

    /**
     * Metodo responsavel por definir o mapeamento de middlewares padroes
     *
     * @param array $map
     */
    public static function setDefault($default){
        self::$default = $default;
    }

    /**
     * Metodo responsavel por executar o proximo nivel da fila de middlewares
     *
     * @param Request $request
     * @return Response
     */

    public function next($request){
        /* echo "<pre>";
        print_r(self::$map);
        echo "</pre>";
        echo "<pre>";
        print_r($this);
        echo "</pre>"; exit; */
        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);
        
        //Middleware
        $middleware = array_shift($this->middlewares);
        //verifica o mapeamento de middlewares
        if(!isset(self::$map[$middleware])){
            throw new \Exception("Problemas ao processar o middlewrare da requisicao", 500);
        }
        //NEXT instancia o middleware
        $queue = $this;
        $next = function($request) use($queue){
            return $queue->next($request);
        };
        //executa o middleware
        return (new self::$map[$middleware])->handle($request, $next);
    }
}

?>