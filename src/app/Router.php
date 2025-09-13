<?php
namespace App;
// declare(strict_type=1);

require_once "Exceptions/RouteNotFoundException.php";
use App\Exceptions\RouteNotFoundException;


class Router
{
    private $routes;

    // this function register new routes and map the to the appropriate method
    // eg localhost/ is mapped to index method in home '/'
    // localhost/invoices is mapped to index method in Invoice class
    public function register(string $route, callable|array $action):self
    {
        $this->routes[$route] = $action;
        return $this;
    }


    // this function collect request URI (e.g localhost/home?foo=1)
    // split it into array on ? symbole (e.g ["localhost/home", "foo=1"])
    // take the first element element of the array which is just the url without query parameter (ie localhost/home)
    public function resolve(string $requestUri)
    {
        
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$route] ?? null;
        
        
        if (!$action ){
            throw new RouteNotFoundException();
        }

        if(is_callable($action)){

            return call_user_func($action);
        }

        if(is_array($action)){
            [$class, $method] = $action;
            if(class_exists($class)){
                $class = new $class();

                if(method_exists($method)){
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

    }
}

