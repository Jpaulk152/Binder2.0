<?php

// namespace Model;

interface dbInterface {

    function from($table);

    function addFilter(string $filter, string $field);

    function match(array $range);

    function unmatch(array $range);

    function fetchAll();

}