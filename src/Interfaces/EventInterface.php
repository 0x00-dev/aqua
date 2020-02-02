<?php


namespace Aqua\Interfaces;

use Closure;

/**
 * Интерфейс события.
 *
 * @package Aqua\Interfaces
 */
interface EventInterface
{
    /**
     * EventInterface constructor.
     *
     * @param string $name Имя
     * @param Closure $action Действие
     */
    public function __construct(string $name, Closure $action);

    /**
     * Получить имя.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Получить действие.
     *
     * @return Closure
     */
    public function getAction(): Closure;
}