<?php 
namespace App\Controller\Pages;


use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;
use \WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Page{

    /**
     * metodo responsavel por obter a renderização dos itens de depoimentos para a pagina
     * @param Request $request
     * @param Pagination
     * @return string
     */
    private static function getTestimonyItems($request, &$obPagination){
        //depoimentos
        $itens = '';

        //quantidade total de registros
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
        /* echo "<pre>";
        print_r($quantidadeTotal);
        echo "</pre>"; */

        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page' ?? 1];

        //instancia de paginacao
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual,3);

        $results = EntityTestimony::getTestimonies(null,'id DESC', $obPagination->getLimit());
        //renderiza o item
        while($obTestimony = $results->fetchObject(EntityTestimony::class)){
            $itens .= View::render('pages/testimony/item', [
                'nome' => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem,
                'data' => date(' d/m/Y H:i:s',strtotime($obTestimony->data))

                
            ]);
            
        }
        return $itens;
    }
    
    /**
     * Metodo responsavel por retornar o conteudo da pagina de depoimentos (view)
     * @param Request $request
     * @return string
     */
    public static function getTestimonies($request){
        
        $content = View::render('pages/testimonies', [
            'itens' => self::getTestimonyItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
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

        //retorna a pagina de listagem de depopimentos
        return self::getTestimonies($request);
    }
}