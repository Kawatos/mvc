<?php 
namespace App\Utils;
Class View {

    /**
     * variaveis padrões da view
     * @var array
     */
    private static $vars = [];

    /**
     * metodo responsavel por definir os dados inciais da classe
     * @param array
     */
    public static function initi($vars = []){
        self::$vars = $vars;
    }

    /**
     * Metodo responsavel por retornar o conteúdo de uma view
     * @param string  $view
     * @return string [type]
     */
    private static function getContentView($view){
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }
    /**
     * Metodo responsavel por retornar o conteudo renderizado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = []) {
        //Conteudo da view
        $contentView = self::getContentView($view);

        $vars = array_merge(self::$vars,$vars);
        // chaves do array de variaveis
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);
    

        //Retorna o conteúdo renderizado
        return str_replace($keys,array_values($vars),$contentView);
    }
}
?>