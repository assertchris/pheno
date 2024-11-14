<?php

return export(default: fn (...$params) => new class (...$params) implements Countable {
    /**
     * @var mixed[]
     */
    private array $items;

    /**
     * @param mixed[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function count(): int
    {
        return count($this->items);
    }
});
