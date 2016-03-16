<?php
namespace App\Classes;

use Psr\Log\AbstractLogger;

class Logger
    extends AbstractLogger
    implements ILogger
{
    use TSingleton;

    protected $fileName = __DIR__ . '/exceptions.txt';

    protected function __construct()
    {
        Application::createFile($this->fileName);
    }

    public function logToJson(\Exception $e)
    {
        $obj = new \stdClass();
        $obj->date = date('d.m.y H:i:s', time());
        $obj->message = $e->getMessage();
        $obj->file = $e->getFile();
        $obj->line = $e->getLine();
        $json = json_encode($obj, JSON_UNESCAPED_UNICODE);
        file_put_contents($this->fileName, $json . PHP_EOL, FILE_APPEND);
    }

    public function log($level, $message, array $context = array())
    {
        self::logToJson($context[0]);
    }

}