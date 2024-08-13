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
     * Data de publicacao dodepoimento
     */
}
?>