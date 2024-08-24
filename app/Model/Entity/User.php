<?php 
namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User{
    /**
     * id do usuario
     * @var integer
     */

    public $id;

    /**
     * nome do usuario
     * @var string
     */

    public $nome;

    /**
     * email do usuario
     * @var string
     */

    public $email;

    /**
     * senha do usuario
     * @var string
     */

    public $senha;

    /**
     * Metodo responnsavel por retornar um usuario com base em seu email
     *
     * @param string $email
     * @return User
     */
    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

}

