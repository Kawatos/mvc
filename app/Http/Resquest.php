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

    public function __construct() {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }
    
}
?>