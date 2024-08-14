<?php 
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;

class Testimony extends Page{

    /**
     * metodo responsavel por obter a renderização dos itens de depoimentos para a pagina
     * @return string
     */
    private static function getTestimonyItems(){
        //depoimentos
        $itens = '';
        $results = EntityTestimony::getTestimonies(null,'id DESC');
        //renderiza o item
        while($obTestimony = $results->fecthObject(EntityTestimony::class)){
            echo "<pre>";
            print_r($obTestimony);
            echo "</pre>"; exit;
        }
        return $itens;
    }
    
    /**
     * Metodo responsavel por retornar o conteudo da pagina de depoimentos (view)
     * @return string
     */
    public static function getTestimonies(){
        
        $content = View::render('pages/testimonies', [
            
        ]);

        return parent::getPage('DEPOIMENTOS > WDEV', $content);
    }

    /**
     * Metodo responsave por cadastrar umdepoimento
     *
     * @param Request $request
     * @return string
     */
    public static function insertTestimony($request){
        //Dados do post
        $postVars= $request->getPostVars();


        //Nova Instancia de Depoimento
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();
        return self::getTestimonies();
    }
}