<?php

class BinarySearch
{
    public array $array; //Array should be arranged
    public int $intSearch;

    public function __construct($array, $intSearch)
    {
        $this->array = $array;
        $this->intSearch = $intSearch;
    }

    public function search($arraySearch = null): ?int
    {
        $array = $arraySearch ?? $this->array;
        $n = count($array);

        if (!$n)
            return null;

        $index = ceil(($n - 1) / 2);

        if ($array[$index] == $this->intSearch)
            return $index;

        else if ($array[$index] < $this->intSearch)
            $this->search(rightside);

        else if ($array[$index] > $this->intSearch)
            $this->search(left side);

        else
            return null;

    }
}