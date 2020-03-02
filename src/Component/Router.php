<?php


namespace Aqua\Component;

use Aqua\Interfaces\ApplicationInterface;

/**
 * Маршрутеризатор.
 *
 * @package Aqua\Component
 */
class Router
{
    /**
     * Маршруты.
     *
     * @var iterable
     */
    private iterable $routes = [];

    /**
     * Маршрут.
     *
     * @var Route|null
     */
    private ?Route $route = null;

    /**
     * Приложение.
     *
     * @var ApplicationInterface
     */
    private ApplicationInterface $app;

    /**
     * Получить маршрут.
     *
     * @return Route|null
     */
    public function getRoute(): ?Route
    {
        return $this->route;
    }

    /**
     * Router constructor.
     *
     * @param ApplicationInterface $application Приложение
     */
    public function __construct(ApplicationInterface $application)
    {
        $this->app = $application;
        $routes = require_once "app/" . $application->getName() . "/config/routes.php";

        foreach ($routes as $route_id => $route) {
            $route_object = new Route($route_id);
            $route_object
                ->setPattern($route['pattern'])
                ->setAction($route['action'])
                ->setAliases($route['aliases'])
                ->setController($route['controller']);
            $this->routes[$route_id] = $route_object;
        }
    }

    /**
     * Запустить.
     *
     * @param string $url Маршрут
     */
    public function run(string $url): void
    {
        foreach ($this->routes as $route) {
            if ($route->match($url)) {
                $this->route = $route;

                continue;
            }
        }
    }
}