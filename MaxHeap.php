<?php


//Calculate height of tree h = logd(n)
//Calculate children
// $first = $d * ($i) + offset(1);
// $second = $d * ($i) + offset(2); and so on based on $d-ary
//$last = $d * ($i) + offset($d);
//$parent = (i - 1)/$d
//comparison per level = d power (k (number of level) + 1)
//comparison of all levels = d x ( (d power(h+1) - 1) / (d-1) )

class MaxHeap
{
    private int $d_ary;
    private array $heap;

    public function __construct($heap, $d_ary)
    {
        $this->heap = $heap;
        $this->d_ary = $d_ary;
    }

    // Build heap from array
    public function build(): void
    {
        // Start from the last non-leaf node
        $start = floor(count($this->heap) / $this->d_ary) - 1;

        // Traverse from the last non-leaf node to the root
        for ($i = $start; $i >= 0; $i--) {
            $this->shiftDown($i);
        }

    }

    // Swap two elements in the array
    public function swap($index, $target): void
    {
        [$this->heap[$index], $this->heap[$target]] = [$this->heap[$index], $this->heap[$target]];
    }

    // Shifting-up
    public function shiftUp($index): void
    {
        // Base case: stop if we are at the root
        if ($index <= 0) {
            return;
        }

        // Calculate the parent index
        $parent = floor(($index - 1) / $this->d_ary);

        // Ensure the Max Heap property
        if ($this->heap[$parent] < $this->heap[$index]) {
            // Swap parent and current node
            $this->swap($parent, $index);

            // Recursively call shiftUp for the parent
            $this->shiftUp($parent);
        }
    }

    // Shift-down
    public function shiftDown($index, $size = null): void
    {
        $size = $size ?? count($this->heap);
        $largest = $index;

        for ($i = 1; $i <= $this->d_ary; $i++) {
            $child = $this->d_ary * ($index) + $i;
            if ($child < $size && $this->heap[$child] > $this->heap[$largest]) {
                $largest = $child;
            }
        }


        if ($largest !== $index) {
            $this->swap($index, $largest);
            $this->shiftDown($largest);
        }
    }

    // Insert
    public function insert($value): void
    {
        $this->heap[] = $value;
        $index = count($this->heap) - 1;
        $this->shiftUp($index);
    }

    // Extract max
    public function extractMax()
    {

        if (empty($this->heap))
            return null;

        $max = $this->heap[0];

        $size = count($this->heap);
        $last_index = $size - 1;
        $this->heap[0] = $this->heap[$last_index];
        unset($this->heap[$last_index]);

        $this->shiftDown(0);

        return $max;
    }

    // Delete
    public function delete($index): void
    {
        if (!isset($this->heap[$index])) {
            throw new InvalidArgumentException("Invalid index: $index");
        }

        $this->heap[$index] = PHP_INT_MAX;

        $this->shiftUp($index);

        $this->extractMax();
    }

    // Heap sort
    public function sort(): void
    {
        $size = count($this->heap);

        $this->build();

        // Step 2: Extract elements one by one
        for ($i = $size - 1; $i > 0; $i--) {
            // Swap the root (max) with the last element
            $this->swap(0, $i);

            // Restore the heap property for the reduced heap
            $this->shiftDown(0, $i); // Pass the reduced size as $i
        }
    }


    // Replace max (new)
    public function replace($value){}

    // Merge heaps (new)
    public function merge($otherHeap){}

    // Clear heap (new)
    public function clear(): void
    {
        $this->heap = [];
    }

    // Change priority
    public function changePriority(): void
    {
        $this->heap = [];
    }


    // Peek max (new)
    public function peekMax()
    {
        return $this->heap[0] ?? null;
    }

    // Is empty (new)
    public function isEmpty(): bool
    {
        return count($this->heap) === 0;
    }

    // Size (new)
    public function size(): int
    {
        return count($this->heap);
    }

}

?>