<?php
/**
 * Double Linked List class
 *
 * This is an implementation of a double linked list
 * as part of an exercise for MCN Healthcare.
 *
 * @author Samson Brock <samsonlb@gmail.com>
 */
require_once 'McnListNode.php';

class McnDoubleLinkedList
{
    private $_headNode;
    private $_currentNode;
    private $_count;

    public function __construct()
    {
        $this->_headNode = NULL;
        $this->_currentNode = NULL;
        $this->_count = 0;
    }

    public function isEmpty()
    {
        return ($this->_headNode === NULL);
    }

    /**
     * Adds a single node to the linked list in ascending order
     *
     * @param int $data the data for the list node
     * @return void
     */
    public function add($data)
    {
        if($this->isEmpty())
        {
            //set the new node as the head node if the linked list is empty
            $this->_currentNode = new McnListNode($data);
            $this->_headNode = $this->_currentNode;
        }
        elseif($data < $this->_headNode->data)
        {
            // add the new node to the beginning of the linked list if its data is less than the head node
            $this->_currentNode = new McnListNode($data);
            $this->_headNode->previous = $this->_currentNode;
            $this->_currentNode->next = $this->_headNode;
            $this->_headNode = $this->_currentNode;
        }
        else
        {
            // insert the new node after the node with the same or lesser data
            $tempNode = $this->_headNode;

            while($tempNode !== NULL && $tempNode->data <= $data)
            {
                $previousNode = $tempNode;
                $tempNode = $tempNode->next;
            }

            $this->_currentNode = new McnListNode($data);
            $this->_currentNode->next = $tempNode;
            $this->_currentNode->previous = $previousNode;

            // link the preceding and following nodes to the new node
            $previousNode->next = $this->_currentNode;
            if($tempNode !== NULL)
            {
                $tempNode->previous = $this->_currentNode;
            }
        }
        $this->_count++;
    }

    /**
     * Gets the total number of nodes in the linked list
     *
     * @return int the total number of list nodes
     */
    public function count()
    {
        return $this->_count;
    }

    /**
     * Gets the first node data in the linked list
     *
     * @return int the first node data or NULL
     */
    public function first()
    {
        if($this->isEmpty()) return NULL;

        $firstData = $this->_headNode->data;

        return $this->valid($firstData) ? $firstData : NULL;
    }

    /**
     * Gets the last node data in the linked list
     *
     * @return int the last node data or NULL
     */
    public function last()
    {
        if($this->isEmpty()) return NULL;

        $tempNode = $this->_headNode;

        while($tempNode->next !== NULL)
        {
            $tempNode = $tempNode->next;
        }

        $tempData = $tempNode->data;

        return $this->valid($tempData) ? $tempData : NULL;
    }

    /**
     * Gets the most recently added node data in the linked list
     *
     * @return int the current node data or NULL
     */
    public function current()
    {
        $currentData = ($this->_currentNode !== NULL) ? $this->_currentNode->data : NULL;

        return $this->valid($currentData) ? $currentData : NULL;
    }

    /**
     * Verifies if the node data is valid
     *
     * @param int the data for the list node
     * @return bool true or false
     */
    public function valid($data)
    {
        return is_int($data);
    }

    /**
     * Gets the next node data in the linked list
     *
     * @return int the next node data or NULL
     */
    public function next()
    {
        $nextData = (($this->_currentNode !== NULL) && ($this->_currentNode->next !== NULL)) ? $this->_currentNode->next->data : NULL;

        return $this->valid($nextData) ? $nextData : NULL;
    }

    /**
     * Gets the previous node data in the linked list
     *
     * @return int the previous node data or NULL
     */
    public function previous()
    {
        $previousData = (($this->_currentNode !== NULL) && ($this->_currentNode->previous !== NULL)) ? $this->_currentNode->previous->data : NULL;

        return $this->valid($previousData) ? $previousData : NULL;
    }

    /**
     * Reverses the order of the node data in the linked list
     *
     * @return void
     */
    public function reverse()
    {
        if($this->isEmpty()) return NULL;

        // reverse the order of the linked list
        $tempNode = $this->_headNode;

        while($tempNode !== NULL)
        {
            $previousNode = $tempNode->previous;
            $tempNode->previous = $tempNode->next;
            $tempNode->next = $previousNode;
            $tempNode = $tempNode->previous;
        }

        if($previousNode !== NULL)
        {
            $this->_headNode = $previousNode->previous;
        }
    }

    /**
     * Echoes the node data in the linked list (first to last)
     *
     * @return void
     */
    public function echoList()
    {
        $tempNode = $this->_headNode;

        while($tempNode !== NULL)
        {
            echo $tempNode->getNodeData() . " ";
            $tempNode = $tempNode->next;
        }
    }
}