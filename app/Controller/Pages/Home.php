<?php 
namespace App\Controller\Pages;

use \App\Utils\View;

class Home extends Page{
    
    /**
     * Metodo responsavel por retornar o conteudo da home
     * @return string
     */
    public static function getHome(){
        $content = View::render('pages/home', [
            'name' => 'WDEV - Canal',
            'description' => 'Canal do youtube: https://youtube.com.br/wdevoficial',
            'site' => 'https://youtube.com.br/wdevoficial'
        ]);

        return parent::getPage('WDEV - Canal - HOME', $content);
    }
}
