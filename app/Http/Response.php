<?php 
namespace App\Http;
class Response{
    /**
     * Código do Status do HTTP
     * @var integer
     */
    private $httpCode = 200;

    /**
     * cabeçalho do response
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteúdo
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteúdo do Response
     * @var mixed
     */
    private $content;

    /**
     * Método responsável por iniciar a classe e definir os valores
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httpCode,$content,$contentType = 'text/html'){
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * Metodo responsável por alterar o content type do response
     * @param string $contentType
     */
    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Content-Type',$contentType);
    }

    /**
     * Método responsável por um registro no cabeçalho de response
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }

    /**
     * 
     */
    private function sendHeaders(){
        //STATUS
        http_response_code($this->httpCode);
        //ENVIAR HEADERS
    }

    /**
     * Metodo responsável por enviar a resposta para o usuário
     */
    public function sendResponse(){
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
            exit;
        }
    }
}
?>