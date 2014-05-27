<?php
namespace PRB\Linter;

class Test
{

    /**
     * @var bool Test status
     */
    public $success = true;

    /**
     * @var mixed The result of the test
     */
    public $result;

    /**
     * @var string The path to the file currently being linted
     */
    public $path;

    /**
     * @var mixed Whatever input is requested
     */
    public $input;

    /**
     * @var string The directory that the package was unzipped in
     */
    public $unzip_dir;

    function __construct($path, $unzip_dir, $input = null)
    {
        if (method_exists($this, 'run')) {
            $this->path = $path;
            $this->input = $input;
            $this->unzip_dir = $unzip_dir;
            $this->run();
        } else {
            $this->success = false;
            $this->result = new Exception('Test does not have a run method.');
        }
        unset($this->input);
        return $this;
    }

}
