<?php
namespace PRB\Linter\Tests;
use PRB\Linter\Test;
use XHPASTNode;
use XHPASTTree;
use AASTNodeList;

/**
 * Class DefinedOrDie
 * Does the file contain a defined or die statement?
 * This is not the actual test in production :P
 *
 * @package PRB\Linter\Tests
 */
class DefinedOrDie extends Test
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

        /** @var AASTNodeList $node */
        $nodes = $root_node->selectDescendantsOfType('n_STATEMENT');

        if ($nodes->count()) {
            $nodes->rewind();

            /** @var XHPASTNode $node */
            $node = $nodes->current();
            $node_string = $node->getConcreteString();

            if (strtolower(substr($node_string, 0, 5)) !== 'defin') {
                $this->result = $node_string;
                $this->success = false;
            }

            $this->result = $node_string;
        }
    }
}
