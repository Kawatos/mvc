<?php 
namespace App\Http\Middleware;

class Maintenance {
    /**
     * Metodo responsavel por executar o middleware.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        //vericva o estado de manutencao da pagina
        if(getenv('MAINTENANCE') == 'true') {
            throw new \Exception("Pagina em manutencao tente novamente mais tarde",200);
        }
        //executa o proximo nivel do middleware
        return $next($request);

    }
}
?>