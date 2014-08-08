<?php
/**
 * List Node class
 *
 * This is a node class to be used with linked lists
 * as part of an exercise for MCN Healthcare.
 *
 * @author Samson Brock <samsonlb@gmail.com>
 */

class McnListNode
{
    public $data;
    public $next;
    public $previous;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getNodeData()
    {
        return $this->data;
    }

}