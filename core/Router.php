<?php

namespace Core;

class Router
{
    /**
     * @var array
     */
    protected array $routes = [];
    protected string $actionRoute;
    protected array $params = [];

    public function __construct()
    {
        $this->setRoutes();
        parse_str((string)parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $this->params);
        $this->actionRoute = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1);
    }

    protected function setRoutes(): void
    {
        $this->routes = require 'core/routes.php';
    }

    protected function getRoute(): ?array
    {
        if (empty($this->routes)) {
            $this->setRoutes();
        }
        return $this->routes[$this->actionRoute] ?? null;
    }


    /**
     * @return void
     */
    public function start()
    {
        $this->startAction($this->getRoute());
    }


    protected function startAction(?array $route): void
    {
        if ($route === null) {
            //TODO 404
            echo 'My page';
            return;
        }
        try{
            (new $route['controller']($route['action'], $this->params));
        }catch (\Throwable $e){
            dump($e->getMessage());
            //throw new $e;
        }

    }

}
