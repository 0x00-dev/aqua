<?php


namespace Aqua\Component;

use Aqua\Interfaces\ApplicationInterface;
use Closure;

abstract class Application implements ApplicationInterface
{
    /**
     * Имя.
     *
     * @var string
     */
    protected string $name = "default";

    /**
     * Активна.
     *
     * @var bool
     */
    protected bool $is_active = false;

    /**
     * При запуске.
     *
     * @var Closure
     */
    protected Closure $on_run;

    /**
     * При остановке.
     *
     * @var Closure
     */
    protected Closure $on_stop;

    /**
     * При удалении.
     *
     * @var Closure
     */
    protected Closure $on_remove;

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     *
     * @todo Реализовать состояния
     */
    public function run(): void
    {
        if (!$this->is_active) {
            if (null !== $this->on_run) {
                ($this->on_run)();
            }

            $this->is_active = true;
        }
    }

    /**
     * @inheritDoc
     */
    public function stop(): void
    {
        if ($this->is_active) {
            if (null !== $this->on_stop) {
                ($this->on_stop)();
            }

            $this->is_active = false;
        }
    }

    /**
     * @inheritDoc
     */
    public function onRun(Closure $closure): ApplicationInterface
    {
        $this->on_run = $closure;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function onStop(Closure $closure): ApplicationInterface
    {
        $this->on_stop = $closure;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function onRemove(Closure $closure): ApplicationInterface
    {
        $this->on_remove = $closure;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }
}