<?php 
namespace App\Utils;
Class View {


    /**
     * Metodo responsavel por retornar o conteúdo de uma view
     * @param string  $view
     * @return string [type]
     */
    private static function getContentView($view){
        $file = __DIR__.'/../../resources/view'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';

    }
    /**
     * Metodo responsavel por retornar o conteudo renderizado de uma view
     * @param string $view
     * @return string
     */
    public static function render($view) {
        //Conteudo da view
        $contentView = self::getContentView($view);
        //Retorna o conteúdo renderizado
        return $contentView;
    }
}
?>