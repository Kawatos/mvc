<?php 
namespace App\Model\Entity;
use \WilliamCosta\DatabaseManager\Database;

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
      //define data
      $this->data = date('Y-m-d H:i:s');
      //insere no banco de dados
      $this->id = (new Database('depoimentos'))->insert([
         'nome' => $this->nome,
         'mensagem' => $this->mensagem,
         'data' => $this->data

      ]);
      //sucesso
      return true;

      /* echo "<pre>";
      print_r($this);
      echo "</pre>"; 
      exit; */
   }

   /**
    * metodo responsavel por retornar depoimentos
    * @param string
    * @param string
    * @param string
    * @param string
    * @return PDOStatement
    */
   public static function getTestimonies($where = null, $order = null, $limit = null, $fields = '*') {
      return (new Database('depoimentos'))->select($where,$order,$limit,$fields);
   }

}
?>