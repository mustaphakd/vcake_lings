<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/12/2017
 * Time: 5:16 PM
 */

namespace Wrsft\Routing\Route;


use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\Event\EventManager;
use Cake\Routing\Route\Route;

class WyswygtRoute extends Route implements EventListenerInterface
{

    private static $param_token = "wyswygt_route";

    public  function parse($url, $method = '')
    {
       // echo "\n\n\t\trunning WyswygtRoute parse method************* ************************";
///pr($this);
        if(isset($this->defaults["controller"])){  //back_controller
           $controller = $this->defaults["controller"] ;
        }
        if(isset($this->defaults["namespace"])){
            $namespace = trim($this->defaults["namespace"], '\\\/') ;
        }

        $params = parent::parse($url, $method); // TODO: Change the autogenerated stub

        if(isset($controller)){
            EventManager::instance()->on($this );
            $controllerArr = explode('\\', trim($controller, '\\'));
           // echo "\n\n\t\trunning WyswygtRoute controller array************* ************************";
           // pr($controllerArr);
            $count = count($controllerArr);
            //$params['controller'] = $controllerArr[ $count - 1];

            if($count > 1){
                //array_pop($controllerArr);
                //$param['plugin'] = implode('\\', $controllerArr) ;
               // $params['plugin'] = '';//$controllerArr[0];
                $params[WyswygtRoute::$param_token] = $controller . 'Controller';
            }
            elseif(isset($namespace)){
                //$params['plugin'] = $namespace ;
                $params[WyswygtRoute::$param_token] =  $namespace . '\\Controller\\'.$controller . 'Controller';
            }
        }

       // pr($params);

        return $params;
    }

    public function match(array $url, array $context = [])
    {
       // echo "\n\n\t\trunning WyswygtRoute match method************* ************************";

        if( strcmp($url["plugin"], $this->defaults["plugin"]) !== 0 ){
            echo "\n\t MATCH METHOD. \t\tWyswygtRoute returning from parent";
            return parent::match($url, $context);
        }

        $destAction = $url['action']?: $context["params"]["action"];
        $destController = $url['controller'] ?: $context["params"]["controller"];

        if(isset($url["_ext"]) && !empty("_ext")){
            $destAction = $destAction . "." . $url["_ext"];
        }

        $keydiff = array_diff( array_keys($url), ["controller", "action", "_ext", "plugin", "prefix"]);
        //echo "\n\t MATCH METHOD. \t\tWyswygtRoute context::";
        //pr($context);
        //pr($url);

        if(isset($context["params"]["_matchedRoute"]) && !empty($context["params"]["_matchedRoute"])) {
            $matchRoute = $context["params"]["_matchedRoute"];
        }
        else{
            $matchRoute = $this->template;
        }
        //echo "\n\n\t\trunning WyswygtRoute match method************before replace* ********** $matchRoute **************";
        $matchRoute = str_replace([":controller", ":action"], [$destController, $destAction], $matchRoute);

        //echo "\n\n\t\trunning WyswygtRoute match method************after replace* ********** $matchRoute **************";

        if (count($keydiff) > 0) {
            $matchRoute .= '?';
            foreach ($keydiff as $key) {
                $matchRoute .= $key . "=" . $url[$key];
            }
        }

        //pr($matchRoute);
        return $matchRoute;
    }

    public function onBeforeDispatcherDispatch( Event $event, $request, $response){

        EventManager::instance()->off($this );
        //echo "\n\n\t\trunning WyswygtRoute Event handler called ************* ************************";
        //pr($request);
        $param = $request->getParam(WyswygtRoute::$param_token);
        $controller = $request->getParam("controller");
        if(isset($param)){

            $reflectionClass = new \ReflectionClass($param);
            $instance = $reflectionClass->newInstance($request, $response, $controller, new EventManager());
            $event->setData("controller", $instance );
        }
        //return null;

    }


    public  function implementedEvents()
    {
        return [
            'Dispatcher.beforeDispatch' => 'onBeforeDispatcherDispatch'
        ];
    }

}