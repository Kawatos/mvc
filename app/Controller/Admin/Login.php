<?php 
namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User;


class Login extends Page{

    /**
     * Metodo responsavel por retornar a renderizacao da pagina de login
     *
     * @param Request $request
     * @return string
     */
    public static function getLogin($request){
        // conteudo da pagina de login
        $content = View::render('admin/login',[]);

        //retorna a pagina completa
        return parent::getPage('Login > WDEV', $content);
    }

    /**
     * Metodo responsavel por definir o login do usuario
     * @param Request $request
     */

    public static function setLogin($request){
        // post vars
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        //busca o usuario pelo email
        $obUser = User::getUserByEmail($email);
        if(!$obUser instanceof User) {
            return self::getLogin($request);
        }
    }

}

?>