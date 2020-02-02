<?php


namespace Aqua\Component;

use Aqua\Interfaces\ServiceInterface;
use Closure;

/**
 * CДиспетчер событий.
 *
 * @package Aqua\Component
 */
class EventDispatcher extends Service implements ServiceInterface
{
    /**
     * События.
     *
     * @var iterable
     */
    private iterable $events = [];

    /**
     * Пул событий.
     *
     * @var iterable
     */
    private iterable $events_pool = [];

    /**
     * При наступлении события.
     *
     * @param string $event_name Имя события
     * @param Closure $action Действие
     */
    public function on(string $event_name, Closure $action)
    {
        $this->events[] = new Event($event_name, $action);
    }

    /**
     * Отправить.
     *
     * @param string $event_name Имя события
     */
    public function send(string $event_name)
    {
        $this->events_pool[] = $event_name;
    }

    /**
     * @inheritDoc
     */
    public static function getInstance()
    {
        return self::$instance ?? self::$instance = new self;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Пулл.
     */
    public function pool()
    {
        foreach ($this->events_pool as $event_name) {
            foreach ($this->events as $event) {
                if ($event->getName() === $event_name) {
                    ($event->getAction())();
                }
            }
        }
    }
}