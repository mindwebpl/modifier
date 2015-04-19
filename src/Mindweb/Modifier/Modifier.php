<?php
namespace Mindweb\Modifier;

interface Modifier
{
    /**
     * @param array $data
     * @return array
     */
    public function modify(array $data);

    /**
     * @return int
     */
    public function getPriority();
} 