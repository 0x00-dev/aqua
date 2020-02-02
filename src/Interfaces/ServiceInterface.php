<?php


namespace Aqua\Interfaces;

/**
 * Интерфейс сервиса.
 *
 * @package Aqua\Interfaces
 */
interface ServiceInterface
{
    /**
     * Получить имя.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Получить экземпляр.
     *
     * @return ServiceInterface
     */
    public static function getInstance();
}