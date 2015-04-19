<?php
namespace Mindweb\Modifier;

class Collection
{
    /**
     * @var array
     */
    private $modifiers = array();

    /**
     * @var array
     */
    private $sorted = array();

    /**
     * @var bool
     */
    private $isSorted = true;

    /**
     * @param Modifier $modifier
     */
    public function add(Modifier $modifier)
    {
        $this->modifiers[] = $modifier;

        $this->isSorted = false;
    }

    /**
     * @param array $data
     * @return array
     */
    public function modify(array $data)
    {
        $this->sort();

        /**
         * @var Modifier $modifier
         */
        foreach ($this->sorted as $modifier) {
            $data = $modifier->modify($data);
        }

        return $data;
    }

    protected function sort()
    {
        if ($this->isSorted) {
            return;
        }

        $this->sorted = $this->modifiers;
        usort ($this->sorted, array ($this, 'sortModifier'));
    }

    /**
     * @param Modifier $left
     * @param Modifier $right
     * @return int
     */
    public function sortModifier(Modifier $left, Modifier $right)
    {
        if ($left->getPriority() === $right->getPriority()) {
            return 0;
        }

        return $left->getPriority() < $right->getPriority() ? -1 : 1;
    }
} 