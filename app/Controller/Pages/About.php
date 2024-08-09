<?php 
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class About extends Page{
    
    /**
     * Metodo responsavel por retornar o conteudo da home
     * @return string
     */
    public static function getHome(){
        $obOrganization = new Organization;
        $content = View::render('pages/about', [
            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
            'site' => $obOrganization->site
        ]);

        return parent::getPage('SOBRE > WDEV', $content);
    }
}
