<?php 
namespace App\Http;

use \Closure;
use Exception;

class Router {
    /**
     * URL completa do projeto (raiz)
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas
     * @var string
     * 
     */
    private $prefix = '';

    /**
     * Indice de rotas
     * @var array
     * 
     */
    private $routes = [];

    /**
     * Instancia de request
     * @var Request
     * 
     */
    private $request;

    /**
     * Metodo responsável por iniciar a classe
     * @param string
     * 
     */
    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * metodo responsável por definir o prefixo das rotas
     * 
     */
    private function setPrefix(){
        //informações da URL atual
        $parseUrl = parse_url($this->url);

        //define o prefixo
        $this->prefix = $parseUrl['path'] ?? '';

        /* echo "<pre>";
        print_r($parseUrl);
        echo "</pre>"; 
        exit;*/
    }

    /**
     * Método responsável por adicionar uma rota na classe
     * @param string
     * @param string
     * @param array
     */
    private function addRoute($method,$route,$params=[]){
    
        //Validação dos parametros
        foreach($params as $key=>$value) {
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Padrao de validacao da url
        $patternRoute = '/^'.str_replace('/', '\/',$route).'$/';

        //adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;
        
    }

    /**
     * metodo responsável por definir uma rota de get
     * @param string $route
     * @param array $params
     * 
     */
    public function get($route, $params = []) {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * metodo responsável por definir uma rota de POST
     * @param string $route
     * @param array $params
     * 
     */
    public function post($route, $params = []) {
        return $this->addRoute('POST', $route, $params);
    }

    /**
     * metodo responsável por definir uma rota de PUT
     * @param string $route
     * @param array $params
     * 
     */
    public function put($route, $params = []) {
        return $this->addRoute('PUT', $route, $params);
    }

    /**
     * metodo responsável por definir uma rota de DELETE
     * @param string $route
     * @param array $params
     * 
     */
    public function delete($route, $params = []) {
        return $this->addRoute('DELETE', $route, $params);
    }

    /**
     * 
     * Metodo responsavel por retornar a uri desconsiderando o profixo
     *
     * @return string
     */
    private function getUri() {
        //URI da request
        $uri = $this->request->getUri();
        /* echo "<pre>";
        print_r($uri);
        echo "</pre>"; 
        exit; */
        //Fatia a uri com o prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];
        //retorna a uri sem prefixo
        return end($xUri);
       
    }


    /**
     * 
     * 
     * Metodo responsavel por retornar os dados da rota atual
     * @return array
     */
    private function getRoute() {
        //URI
        $uri = $this->getUri();
        //method
        $httpMethod = $this->request->getHttpMethod();
        //valida as rotas
        foreach($this->routes as $patternRoute=>$methods) {
            //VERIFICA SE A uri BATYE O PADRAO
            if(preg_match($patternRoute,$uri)){
                //verifica o metodo
                if ($methods[$httpMethod]){
                    return $methods [$httpMethod];
                }
                //metodo nao permitido/definido
                throw new Exception("Metodo nao e permitido", 405);
            }
        }
        //url nao encontrada
        throw new Exception("URL nao encontrada", 404);
    }


    /**
     * metodo responsavel por executar a rota atual
     * @return Response
     */
    public function run(){
        try{
            //Obtem a rota atual
            $route = $this->getRoute();
            if(!isset($route['controller'])){
                throw new Exception("URL nao pode ser processada", 500);
            }

            //argumentos da funcao
            $args = [];
            //retorna a execucao da funcao
            return call_user_func_array($route['controller'], $args);
            /* echo "<pre>";
            print_r($route);
            echo "</pre>"; 
            exit; */
        } catch(Exception $e) {
            return new Response($e->getCode(),$e->getMessage());
        }
    }
}
?>