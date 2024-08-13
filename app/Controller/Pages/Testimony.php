<?php 
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Testimony extends Page{
    
    /**
     * Metodo responsavel por retornar o conteudo da pagina de depoimentos (view)
     * @return string
     */
    public static function getTestimonies(){
        
        $content = View::render('pages/testimonies', [
            
        ]);

        return parent::getPage('DEPOIMENTOS > WDEV', $content);
    }
}
