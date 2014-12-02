<?php
/**
 * fewlines CMS
 *
 * Description: This class calls all the necessary functions
 * to build the rendered view
 *
 * @copyright Copyright (c) fewlines
 * @author Davide Perozzi
 */

namespace Fewlines\Application;

require_once "Fewlines/Autoloader/Autoloader.php";

use Fewlines\Handler\Error as ErrorHandler;
use Fewlines\Http\Request as HttpRequest;
use Fewlines\Template\Template as Template;
use Fewlines\Database\Database as Database;
use Fewlines\Session\Session;

class Application
{
	/**
	 * Tells wether the application was already
	 * runned or not
	 *
	 * @var boolean
	 */
	private $wasRunned = false;

	/**
	 * Instance of the request object
	 *
	 * @var \Fewlines\Http\Request
	 */
	private $httpRequest;

	/**
	 * Holds the current template which was
	 * build together
	 *
	 * @var \Fewlines\Template\Template
	 */
	private $template;

	/**
	 * @param string $autoloaderFnc The function of the autoloader
	 */
	public function __construct($autoloaderFnc)
	{
		// Add autoloader
		$this->registerAutoloader($autoloaderFnc);

		// Register all components
		Session::startSession();
		$this->registerErrorHandler();
		$this->registerHttpRequest();
		$this->registerTemplate();

		// Render the frontend
		$this->renderApplication();

        $test2 = array(
            array(
                "vorname",
                "=",
                "Maurice",
            ),
            array(
                "AND",
                "nachname",
                "=",
                "Kern",
            ),
        );
        //$test = new Database("localhost", "root", "","klassentest");
        //$test->where($test2);
	}

	/**
	 * Gets all http request informations
	 */
	public function registerHttpRequest()
	{
		$this->httpRequest = new HttpRequest();
	}

	/**
	 * Get the template with the
	 * http request
	 */
	private function registerTemplate()
	{
		$this->template = new Template(
				$this->httpRequest->getUrlMethodContents()
			);
	}

	/**
	 * Renders the applications frontend
	 */
	private function renderApplication()
	{
		$this->template->render();
	}

	/**
	 * Runs the application
	 *
	 * @return boolean
	 */
	public function run()
	{
		$this->wasRunned = true;
	}

	/**
	 * Returns the state of the application
	 *
	 * @return boolean
	 */
	public function wasRunned()
	{
		return $this->wasRunned;
	}

	/**
	 * Registers the autoload function
	 *
	 * @param  function
	 * @return booleam
	 */
	private function registerAutoloader($fnc)
	{
		return spl_autoload_register($fnc);
	}

	/**
	 * Set the error handling function
	 * to transform erros to execptions
	 */
	private function registerErrorHandler()
	{
		set_error_handler(array(new ErrorHandler(), 'handleError'));
	}
}

?>