<?php


namespace Aqua\Core;

use Aqua\Component\EventDispatcher;
use Aqua\Interfaces\ApplicationInterface;

/**
 * Ядро.
 *
 * @package Aqua\Core
 */
class Kernel
{
    /**
     * Приложения.
     *
     * @var iterable
     */
    private iterable $applications = [];

    /**
     * Экземпляр.
     *
     * @var Kernel
     */
    private static ?Kernel $instance;

    /**
     * Kernel constructor.
     */
    private function __construct()
    {
    }

    /**
     * Clone.
     */
    private function __clone()
    {
    }

    /**
     * Инициализировать.
     *
     * Singleton.
     */
    public static function init(): Kernel
    {
        return self::$instance ?? self::$instance = new self;
    }

    /**
     * Зарегистрировать приложение.
     *
     * @param ApplicationInterface $application Экземпляр приложения
     *
     * @return Kernel
     */
    public function register(ApplicationInterface $application): Kernel
    {
        $application->run();
        $this->applications[$application->getName()] = $application;

        return $this;
    }

    /**
     * Приложение зарегистрировано.
     *
     * @param string $name Имя приложения
     *
     * @return bool
     */
    public function hasApp(string $name): bool
    {
        return \array_key_exists($name, $this->applications);
    }

    /**
     * Получить приложение.
     *
     * @param string $name Имя
     *
     * @return ApplicationInterface|null
     */
    public function getApp(string $name): ?ApplicationInterface
    {
        return $this->hasApp($name) ? $this->applications[$name] : null;
    }

    /**
     * Удалить приложение.
     *
     * @param string $name Имя
     */
    public function remove(string $name): void
    {
        if ($this->hasApp($name)) {
            $this->getApp($name)->stop();
            $this->applications = $this->applications - $name;
        }
    }
}