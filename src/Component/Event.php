<?php


namespace Aqua\Component;

use Aqua\Interfaces\EventInterface;

use Closure;

/**
 * Событие.
 *
 * @package Aqua\Component
 */
class Event implements EventInterface
{
    /**
     * Имя.
     *
     * @var string
     */
    protected string $name = "Undefined";

    /**
     * Действие.
     *
     * @var Closure
     */
    protected Closure $action;

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getAction(): Closure
    {
        return $this->action;
    }

    /**
     * @inheritDoc
     */
    public function __construct(string $name, Closure $action)
    {
        $this->name = $name;
        $this->action = $action;
    }
}