<?php 
namespace App\Model\Entity;
class Testimony{
    /**
     * Id do depoimento
     * @var integer
     * 
     */
    public $id;

    /**
     * Nomde do usuario que fez o depoimento
     * @var string
     * 
     */
    public $nome;

    /**
     * Mensagem do depoimento
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicacao do depoimento
     */

    public $data;
    /**
     * metodo responsavel por cadastrar a instancia no banco de dados
     * @return boolean
     */

     public function cadastrar(){
        echo "<pre>";
        print_r($this);
        echo "</pre>"; 
        exit;
     }

}
?>