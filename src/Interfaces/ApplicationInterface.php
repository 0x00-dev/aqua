<?php


namespace Aqua\Interfaces;

use Closure;

/**
 * Интерфейс приложения.
 *
 * @package Aqua\Interfaces
 */
interface ApplicationInterface
{
    /**
     * Получить имя.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Запустить.
     */
    public function run(): void;

    /**
     * Остановить.
     */
    public function stop(): void;

    /**
     * Активно.
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * При запуске.
     *
     * @param Closure $closure Действие
     *
     * @return ApplicationInterface
     */
    public function onRun(Closure $closure): ApplicationInterface;

    /**
     * При остановке.
     *
     * @param Closure $closure Действие
     *
     * @return ApplicationInterface
     */
    public function onStop(Closure $closure): ApplicationInterface;

    /**
     * При удалении.
     *
     * @param Closure $closure Действие
     *
     * @return ApplicationInterface
     */
    public function onRemove(Closure $closure): ApplicationInterface;
}