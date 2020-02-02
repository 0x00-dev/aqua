<?php


namespace Aqua\Component;

use Aqua\Interfaces\ServiceInterface;

/**
 * Сервис.
 *
 * @package Aqua\Component
 */
abstract class Service
{
    /**
     * Имя.
     *
     * @var string
     */
    protected string $name = "undefined";

    /**
     * Экземпляр.
     *
     * @var ServiceInterface
     */
    protected static ServiceInterface $instance;

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }
}