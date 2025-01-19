<?php

class DisjointSets {
    public array $sets = [];
    public array $rank = [];

    // Initialize the sets
    public function makeSet($size): void
    {
        for ($i = 0; $i < $size; $i++) {
            $this->sets[$i] = $i; // Each element is its own parent
            $this->rank[$i] = 0; // Initial rank is 0
        }
    }

    // Find the root with path compression
    public function find($x) {
        if ($this->sets[$x] != $x) {
            $this->sets[$x] = $this->find($this->sets[$x]); // Path compression
        }
        return $this->sets[$x];
    }

    // Union by rank
    public function union($x, $y): void
    {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootX != $rootY) {
            if ($this->rank[$rootX] > $this->rank[$rootY]) {
                $this->sets[$rootY] = $rootX;
            } elseif ($this->rank[$rootX] < $this->rank[$rootY]) {
                $this->sets[$rootX] = $rootY;
            } else {
                $this->sets[$rootY] = $rootX;
                $this->rank[$rootX]++;
            }
        }
    }
}


//class MazeSolver {
//    private $disjointSet;
//    private $rows;
//    private $cols;
//
//    public function __construct($rows, $cols) {
//        $this->rows = $rows;
//        $this->cols = $cols;
//        $this->disjointSet = new DisjointSets();
//        $this->disjointSet->makeSet($rows * $cols); // Each cell is a node
//    }
//
//    private function cellId($row, $col) {
//        return $row * $this->cols + $col;
//    }
//
//    public function connect($row1, $col1, $row2, $col2) {
//        $cell1 = $this->cellId($row1, $col1);
//        $cell2 = $this->cellId($row2, $col2);
//        $this->disjointSet->union($cell1, $cell2);
//    }
//
//    public function isConnected($startRow, $startCol, $endRow, $endCol): bool
//    {
//        $start = $this->cellId($startRow, $startCol);
//        $end = $this->cellId($endRow, $endCol);
//        return $this->disjointSet->find($start) == $this->disjointSet->find($end);
//    }
//}
//
//// Example usage:
//$maze = new MazeSolver(3, 3); // 3x3 maze
//
//// Connect cells (remove walls)
//$maze->connect(0, 0, 0, 1); // Connect (0,0) to (0,1)
//$maze->connect(0, 1, 1, 1); // Connect (0,1) to (1,1)
//$maze->connect(1, 1, 2, 1); // Connect (1,1) to (2,1)
//
//// Check connectivity
//if ($maze->isConnected(0, 0, 2, 1)) {
//    echo "Path exists!";
//} else {
//    echo "No path!";
//}