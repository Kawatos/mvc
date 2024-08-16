<?php 
namespace App\Controller\Pages;

use \App\Utils\View;

class Page {
    /**
     * Metodo responsavel por renderizar o topo da pagina
     *
     * @return string
     */
    private static function getHeader() {
        return View::render('pages/header');
    }
    /**
     * Metodo responsavel por renderizar o rodape da pagina
     *
     * @return string
     */
    private static function getFooter() {
        return View::render('pages/footer');
    }

    /**
     * metodo responsavel por renderizar o layout de paginacao
     *
     * @param Request $request
     * @param Pagination $obPagination
     * @return string
     */
    public static function getPagination($request, $obPagination){
        //paginas
        $pages = $obPagination->getPages();

        //verifica a quantidade de paginas
        if(count($pages) <= 1) return '';

        //links
        $links = '';
        
        //url atual sem gets 
        $url = $request->getRouter()->getCurrentUrl();

        //get
        $queryParams = $request->getQueryParams();

        //renderizar os links

        foreach($pages as $page){
            
            //altera a pagina
            $queryParams['page'] = $page['page'];

            //montando o link da pagina
            $link = $url.'?'.http_build_query($queryParams);
            //view
            $links .= View::render('pages/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''

            ]);
        }

        //renderiza box de pagincao

        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
        
        
    }

    /**
     * Metodo responsavel por retornar o conteudo da pagina generica
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('pages/page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}
