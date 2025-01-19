<?php

class QuickSort
{
    protected array $arr;

    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    public function sort(int $low = null, int $high = null): array
    {
        // Initialize low and high if not provided
        $low = $low ?? 0;
        $high = $high ?? count($this->arr) - 1;

        if ($low < $high) {
            [$lt, $gt] = $this->partition($low, $high);

            // Recursively sort the partitions
            $this->sort($low, $lt - 1);
            $this->sort($gt + 1, $high);
        }

        return $this->arr;
    }

    private function partition(int $low, int $high): array
    {
        $pivot = $this->arr[$high];
        $lt = $low;
        $gt = $high;
        $i = $low;

        while ($i <= $gt) {
            if ($this->arr[$i] < $pivot) {
                [$this->arr[$i], $this->arr[$lt]] = [$this->arr[$lt], $this->arr[$i]];
                $lt++;
                $i++;
            } elseif ($this->arr[$i] > $pivot) {
                [$this->arr[$i], $this->arr[$gt]] = [$this->arr[$gt], $this->arr[$i]];
                $gt--;
            } else {
                $i++;
            }
        }

        return [$lt, $gt];
    }
}

// Example Usage
$data = [4, 2, 5, 3, 1, 4, 4, 2, 7, 8];
$sorter = new QuickSort($data);
$sortedData = $sorter->sort();

print_r($sortedData);
