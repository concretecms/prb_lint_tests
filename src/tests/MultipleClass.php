<?php
namespace PRB\Linter\Tests;
use PRB\Linter\Test;
use XHPASTNode;
use XHPASTTree;
use AASTNodeList;

/**
 * Class MultipleClass
 * Does the file contain more than 1 class?
 *
 * @package PRB\Linter\Tests
 */
class MultipleClass extends Test
{

    /**
     * @var \XHPASTTree $tree
     */
    public $input;

    /**
     * The actual testing method
     */
    public function run()
    {
        /** @var XHPASTNode $root_node */
        $root_node = $this->input->getRootNode();

        /** @var AASTNodeList $classes */
        $classes = $root_node->selectDescendantsOfType('n_CLASS_DECLARATION');

        $class_symbols = array();
        foreach ($classes as $class_node) {
            /** @var XHPASTNode $class_node */
            $class_symbols[] = $class_node->getStringLiteralValue();
        }

        $this->result = $class_symbols;
        $this->success = count($this->result) < 2;
    }
}
