<?php


namespace Aqua\Component;

/**
 * Маршрут.
 *
 * @package Aqua\Component
 */
class Route
{
    /**
     * Идентификатор.
     *
     * @var string
     */
    private string $id = "unnamed";

    /**
     * Найден по URL.
     *
     * @var string
     */
    private string $url_match = "/";

    /**
     * Шаблон.
     *
     * @var string
     */
    private string $pattern = "/";

    /**
     * Контроллер.
     *
     * @var string
     */
    private string $controller = "";

    /**
     * Действие.
     *
     * @var string
     */
    private string $action = "index";

    /**
     * Заполнители.
     *
     * @var iterable
     */
    private iterable $placeholders = [];

    /**
     * Псевдонимы.
     *
     * @var iterable
     */
    private iterable $aliases = [];

    /**
     * Route constructor.
     *
     * @param string $id Идентификатор
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Содержит.
     *
     * @param string $url Адрес
     *
     * @return bool
     */
    public function match(string $url): bool
    {
        $this->url_match = $url;
        $matches = [];
        $result = \preg_match("~^{$this->pattern}$~miu", $this->url_match, $matches);
        if ($result) {
            $matches = array_slice($matches, 1);
            foreach ($matches as $match) {
                foreach ($this->aliases as $name => $pattern) {
                    if (\preg_match("~^$pattern$~miu", $match)) {
                        $this->placeholders[$name] = $match;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Получить шаблон.
     *
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * Установить шаблон.
     *
     * @param string $pattern Шаблон
     *
     * @return Route
     */
    public function setPattern(string $pattern): Route
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * Построить.
     *
     * @return Route
     */
    public function build(): Route
    {
        $matches = [];
        preg_match("~^{$this->pattern}$~", $this->url_match, $matches);

        return $this;
    }

    /**
     * Получить идентификатор.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Получить найденный адрес.
     *
     * @return string
     */
    public function getUrlMatch(): string
    {
        return $this->url_match;
    }

    /**
     * Получить контроллер.
     *
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Получить действие.
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Получить подстановки.
     *
     * @return iterable
     */
    public function getPlaceholders(): iterable
    {
        return $this->placeholders;
    }

    /**
     * Получить псевдонимы.
     *
     * @return iterable
     */
    public function getAliases(): iterable
    {
        return $this->aliases;
    }

    /**
     * Установить псевдонимы.
     *
     * @param iterable $aliases Псевдонимы
     *
     * @return Route
     */
    public function setAliases(iterable $aliases): Route
    {
        $this->aliases = $aliases;

        return $this;
    }

    /**
     * Установить действие.
     *
     * @param string $action Действие
     *
     * @return Route
     */
    public function setAction(string $action): Route
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Установить контроллер.
     *
     * @param string $controller Контроллер
     *
     * @return Route
     */
    public function setController(string $controller): Route
    {
        $this->controller = $controller;

        return $this;
    }
}
