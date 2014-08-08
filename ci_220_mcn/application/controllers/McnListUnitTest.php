<?php
/**
 * Unit tests for McnDoubleLinkedList
 *
 * This is a CI Unit Test of the McnDoubleLinkedList methods
 * as part of an exercise for MCN Healthcare.
 *
 * @author Samson Brock <samsonlb@gmail.com>
 */
class McnListUnitTest extends CI_Controller
{
    private $_head;
    private $_last;
    private $_count;
    private $_myList;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('unit_test'); // Load CI Unit Test class
        $this->load->library('McnDoubleLinkedList');

        $this->_head = 1;
        $this->_last = 100;
        $this->_count = 0;
        $this->_myList = new McnDoubleLinkedList();
    }

    public function index()
    {
        $this->testInitialStates();
        $this->testListCreation();
        $this->testInsertion();
        $this->testReversal();

        // Run a full report of all tests
        echo $this->unit->report();
    }

    private function testInitialStates()
    {
        $this->unit->run($this->_myList->first(), NULL, 'first() starts as NULL');
        $this->unit->run($this->_myList->last(), NULL, 'last() starts as NULL');
        $this->unit->run($this->_myList->previous(), NULL, 'previous() starts as NULL');
        $this->unit->run($this->_myList->next(), NULL, 'next() starts as NULL');
        $this->unit->run($this->_myList->current(), NULL, 'current() starts as NULL');
        $this->unit->run($this->_myList->reverse(), NULL, 'reverse() starts as NULL');
        $this->unit->run($this->_myList->count(), 0, 'count() starts as 0');
    }

    private function testListCreation()
    {
        for($this->_count = $this->_head; $this->_count <= $this->_last; $this->_count++)
        {
            $this->_myList->add($this->_count);
        }
        $this->_count--;

        $this->unit->run($this->_myList->first(), $this->_head, 'first() matches head');
        $this->unit->run($this->_myList->last(), $this->_last, 'last() matches last');
        $this->unit->run($this->_myList->previous(), $this->_last - 1, 'previous() matches last - 1');
        $this->unit->run($this->_myList->next(), NULL, 'next() is NULL');
        $this->unit->run($this->_myList->current(), $this->_last, 'current() matches last');
        $this->unit->run($this->_myList->count(), $this->_count, 'count() matches count');
    }

    private function testInsertion()
    {
        $this->_myList->add(50);
        $this->_count++;

        $this->unit->run($this->_myList->first(), $this->_head, 'first() matches head');
        $this->unit->run($this->_myList->last(), $this->_last, 'last() matches last');
        $this->unit->run($this->_myList->previous(), 50, 'previous() is 50');
        $this->unit->run($this->_myList->next(), 51, 'next() is 51');
        $this->unit->run($this->_myList->current(), 50, 'current() is 50');
        $this->unit->run($this->_myList->count(), $this->_count, 'count() matches count');

        $this->_myList->add(25);
        $this->_count++;

        $this->unit->run($this->_myList->first(), $this->_head, 'first() matches head');
        $this->unit->run($this->_myList->last(), $this->_last, 'last() matches last');
        $this->unit->run($this->_myList->previous(), 25, 'previous() is 25');
        $this->unit->run($this->_myList->next(), 26, 'next() is 26');
        $this->unit->run($this->_myList->current(), 25, 'current() is 25');
        $this->unit->run($this->_myList->count(), $this->_count, 'count() matches count');

        $this->_myList->add(101);
        $this->_last = 101;
        $this->_count++;

        $this->unit->run($this->_myList->first(), $this->_head, 'first() matches head');
        $this->unit->run($this->_myList->last(), $this->_last, 'last() matches last');
        $this->unit->run($this->_myList->previous(), 100, 'previous() is 100');
        $this->unit->run($this->_myList->next(), NULL, 'next() is NULL');
        $this->unit->run($this->_myList->current(), 101, 'current() is 101');
        $this->unit->run($this->_myList->count(), $this->_count, 'count() matches count');

        $this->_myList->add(0);
        $this->_head = 0;
        $this->_count++;

        $this->unit->run($this->_myList->first(), $this->_head, 'first() matches head');
        $this->unit->run($this->_myList->last(), $this->_last, 'last() matches last');
        $this->unit->run($this->_myList->previous(), NULL, 'previous() is NULL');
        $this->unit->run($this->_myList->next(), 1, 'next() is 1');
        $this->unit->run($this->_myList->current(), 0, 'current() is 0');
        $this->unit->run($this->_myList->count(), $this->_count, 'count() matches count');
    }

    private function testReversal()
    {
        $this->_myList->add(75);
        $this->_count++;

        $this->_myList->reverse();

        $this->unit->run($this->_myList->first(), $this->_last, 'first() matches last');
        $this->unit->run($this->_myList->last(), $this->_head, 'last() matches head');
        $this->unit->run($this->_myList->previous(), 76, 'previous() is 76');
        $this->unit->run($this->_myList->next(), 75, 'next() is 75');
        $this->unit->run($this->_myList->current(), 75, 'current() is 75');
        $this->unit->run($this->_myList->count(), $this->_count, 'count() matches count');
    }
}