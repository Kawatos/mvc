<?php 
namespace App\Controller\Admin;

use \App\Utils\View;

class Page {

    /**
     * Metodo responsavel por retornar o conteudo (view) da estrutura generica de pagina do painel
     *
     * @param String $title
     * @param String $content
     * @return String
     */
    public static function getPage($title, $content){
        return View::render('admin/page', [
            'title' => $title,
            'content' => $content
        ]);
    }

}


?>