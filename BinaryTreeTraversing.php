<?php

// Define Node structure
class Node {
    public $data;
    public $left;
    public $right;

    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

// Binary Tree Class with Traversal Methods
class BinaryTree {
    public $root;

    public function __construct($binaryTree) {
        $this->root = $binaryTree;
    }

    // Preorder Traversal (Root, Left, Right)
    public function preOrder($node) {
        if ($node === null) return;
        echo $node->data . " ";
        $this->preOrder($node->left);
        $this->preOrder($node->right);
    }

    // Inorder Traversal (Left, Root, Right)
    public function inOrder($node) {
        if ($node === null) return;
        $this->inOrder($node->left);
        echo $node->data . " ";
        $this->inOrder($node->right);
    }

    // Postorder Traversal (Left, Right, Root)
    public function postOrder($node) {
        if ($node === null) return;
        $this->postOrder($node->left);
        $this->postOrder($node->right);
        echo $node->data . " ";
    }
}

// Creating Binary Tree
$tree = new BinaryTree(null);
$tree->root = new Node(1);
$tree->root->left = new Node(2);
$tree->root->right = new Node(3);
$tree->root->left->left = new Node(4);
$tree->root->left->right = new Node(5);

// Display Tree Traversal
echo "Preorder Traversal: ";
$tree->preOrder($tree->root);
echo PHP_EOL;

echo "Inorder Traversal: ";
$tree->inOrder($tree->root);
echo PHP_EOL;

echo "Postorder Traversal: ";
$tree->postOrder($tree->root);
echo PHP_EOL;

?>
