<?php

namespace Models\DB;

interface DBInterface {

    function from($table);

    function addFilter(string $filter, string $field);

    function match(array $range);

    function unmatch(array $range);

    function fetchAll();

}