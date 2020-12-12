<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiameterOfBinaryTree extends Controller
{
    public $node = null;

    public function newNode($data)
    {
        return $nodeData = (object) array("data" => $data, "left" => null, "right" => null);
    }

    public function getMax($a, $b){
        if($a >= $b)
            return $a;
        else
            return $b;
    }

    public function generateTree()
    {
        $this->node = $this->newNode(1);
        $this->node->left = $this->newNode(2);
        $this->node->right = $this->newNode(3);
        
        $this->node->left->left = $this->newNode(4);
        $this->node->left->right = $this->newNode(5);
                
        return $this->node;
    }

    /*
    Returns total number of nodes(size) in a bianry tree
    getHeight(root) = Maximum of (getHeight(left-subTree), getHeight(right-subTree)) + 1;
    */
    public function getHeight($node){
        $leftHeight =0; $rightHeight=0;
        if (empty($node))
            return 0;
        $leftHeight = $this->getHeight($node->left);
        $rightHeight = $this->getHeight($node->right);
        
        return $this->getMax($leftHeight, $rightHeight) + 1;
    }

    /* Returns the diameter of a binary tree */
    public function getDiameter($node) {
        /* Empty Tree  */
        if (empty($node))
            return 0;
        
        /* Calculate the heigh of the left and right sub-tree  */
        $leftHeight = $this->getHeight($node->left);
        $rightHeight = $this->getHeight($node->right);
        
        /* Recursively calculate the diameter of 
            left and right sub-trees */
        $leftDiameter = $this->getDiameter($node->left);
        $rightDiameter = $this->getDiameter($node->right);
        
        
        return $this->getMax($leftHeight + $rightHeight + 1, 
        $this->getMax($leftDiameter, $rightDiameter));
    }
    public function index()
    {
    
        echo '<br/><br/><div align="center">';
        echo  "1 <br/>
        /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\ <br/>
      2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3<br/>
     /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <br/>
    4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";    

        echo '<h1>'.$this->getDiameter($this->generateTree());
    
        echo '</h1><a href="/api/">BACK</a></div>';
    }

}
