# Automated Marketplace Tests

This repository holds some tests to be used as examples to writing your own tests. We at concrete5 have made this repository so that we can open up our linting process to whoever can help.  
Please write your class either in a way that it handles any php file, or for a subset of php files which should describe in your pull request / code comments.

### Setup
In order to get started, you'll need to run initialize the bundled vagrant, install the composer dependencies, and build [xhpast](https://github.com/facebook/libphutil/tree/master/support/xhpast).
Likely, these commands are:

	$ vagrant up;
	$ vagrant ssh;
	$ cd /var/www;
	$ composer install;
	$ sh /var/www/support/libphutil/scripts/build_xhpast.sh
	
### Running Tests
To run the tests, just run `php /var/www/run_test.php`

### Writing Tests

The sample test engine grabs all tests from the `src/tests/` directory, and instantiates them following PSR-4's class definition.  
In order to add a test, simply create the file and extend the `\PRB\Linter\Test` class.

Tests can be given whatever input they need, just describe your input in your pull request and comment your class well. The actual implementation into the linter itself will be done by me at my discretion.

I ask that you follow PSR-2 in providing new tests, and that you comment your class well so that I, and others to come, can understand it quickly and more wholly.