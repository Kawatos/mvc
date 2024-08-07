<?php 
namespace App\Http;
class Request{
    /**
     * Método HTTP de requisição
     * @var string
     */
    private $httpMethod;
    /**
     * URI da pagina
     * @var string
     */
    private $uri;
    /**
     * Parâmetros da URL ($_GET)
     * @var array
     * 
     */
    private $queryParams = [];
    /**
     * variáveis recebidas no POST da página ($_POST)
     * @var array
     */
    private $postVars = [];
    /**
     * cabeçalho da requisição
     * @var array
     * 
     */
    private $headers = [];
    /**
     * Construtor da classe
     */

    public function __construct(){
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }
    /**
     * Metodo responsável por retornar o método Http da requisição
     * @return string
     */
    public function getHttpMethod(){
        return $this->httpMethod;
    }
    /**
     * Metodo responsável por retornar a URI da requisição
     * @return string
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * Metodo responsável por retornar os headers da requisição
     * @return array
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * Metodo responsável por retornar os parametros URL da requisição
     * @return array
     */
    public function getQueryParams(){
        return $this->queryParams;
    }

    /**
     * Metodo responsável por retornar o post da requisição
     * @return array
     */
    public function getPostVars(){
        return $this->postVars;
    }
}
?>