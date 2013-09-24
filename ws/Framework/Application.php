<?php

namespace Framework;

use \ReflectionClass;
use \ReflectionMethod;
use Framework\Json;
use Framework\Session;

class Application
{
	const ERROR_WS_NOT_FOUND = 'ERROR_WS_NOT_FOUND';

	private $phpInput;
	private $serverQueryString;
	private $serverRequestMethod;
	private $httpResponse;
	private $json;

	public static function Run()
	{
		$app = new self();
		$app->findAction();
	}

	private function __construct()
	{
		$this->phpInput = file_get_contents('php://input');
		$this->serverQueryString = $_SERVER['QUERY_STRING'];
		$this->serverRequestMethod = $_SERVER['REQUEST_METHOD'];

		$this->httpResponse = HttpResponse::getInstance();
		$this->json = JSON::getInstance();
	}

	private function findAction()
	{
		$foundWS = false;

		if ($handle = opendir(__DIR__.'/../Controller')) {

			while (false !== ($file = readdir($handle))) {

				if ($file != '.' && $file != '..') {
					$name = str_replace('Controller.php', '', $file);
					$controllerClass = 'Controller\\' . $name . 'Controller';
					$dtoClass = 'DTO\\' . $name . 'DTO';

					$reflection = new ReflectionClass($controllerClass);
					$docComment = str_replace(' ', '', $reflection->getDocComment());

					if (preg_match('/@RequestMapping\("([\/a-z]+)"\)/', $docComment, $matches)) {
						$requestMapping = $matches[1];

						foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {

							if ($method->name != '__construct') {
								$docComment = str_replace(' ', '', $method->getDocComment());

								if (preg_match('/@RequestMapping\(value="([\/:a-z]*)",method=([GET|POST|PUT|DELETE]*)/', $docComment, $matches)) {
									$requestMappingValue = $matches[1];
									$requestMappingMethod = $matches[2];

									$pattern = $requestMapping . $requestMappingValue;
									$pattern = '/' . trim($pattern, '/');
									$pattern = str_replace('/', '\/', $pattern);
									$pattern = str_replace(':id', '([0-9]+)', $pattern);
									$pattern = str_replace(':name', '([a-z]+)', $pattern);

									if (preg_match("/^$pattern\/?(&(.*))?$/", $this->serverQueryString, $matches) && $this->serverRequestMethod == $requestMappingMethod) {
										$foundWS = true;
										$param = isset($matches[1]) ? $matches[1] : null;

										$this->doAction($controllerClass, $dtoClass, $method, $requestMappingMethod, $param);
									}
								}
							}
						}
					}
				}
			}
			closedir($handle);
		}

		if (!$foundWS) {
			$this->httpResponse->setError(self::ERROR_WS_NOT_FOUND, 400);
		}

		$this->httpResponse->setJsonResponse($this->json);
		$this->httpResponse->send();
	}

	private function doAction($controllerClass, $dtoClass, $method, $requestMethod, $param)
	{
		$controller = new $controllerClass;

		if ($param && ($requestMethod == 'GET' || $requestMethod == 'DELETE')) {
			$result = $controller->{$method->name}($param);

		} else if (!$param && $requestMethod == 'GET') {
			$result = $controller->{$method->name}();

		} else if ($requestMethod == 'POST' || $requestMethod == 'PUT') {
			$dto = new $dtoClass;
			$object = json_decode($this->phpInput);
			foreach ($object as $key => $val) {
				$dto->{$key} = $val;
			}
			$controller->{$method->name}($dto);
			$result = $dto;
		}

		$this->json->setData($result);
	}
}