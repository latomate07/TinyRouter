<?php
namespace TinyRouter\Render;

class View
{
    /**
     * Get views path
     * 
     * @var string
     */
    const RESOURCE_PATH = "resources/views/";

    /**
     * Render view file
     * @param string $fileName
     * @param array|null $arguments
     * @return View
     */
    public static function render(string $fileName, array|null $arguments = NULL)
    {
        // Clear the cache
        clearstatcache();
        // Add file extension
        $fileName .= '.php';

        $actualResources = scandir('../resources/views');
        $fileCheck = array_filter($actualResources, function ($element) use($fileName) {
            return $element === $fileName;
        });

        // Make sure that file we need exists
        if(implode($fileCheck) !== $fileName)
        {
            http_response_code(404);
            die();
        }

        // Get view we need
        $view = self::RESOURCE_PATH . $fileName;

        // Add arguments in post global variable
        if(!is_null($arguments))
        {
            foreach($arguments as $key => $value)
            {
                $_POST[$key] = $value;
            }
        }
        // Get view
        require_once('../' . $view);

        // Authorize chaining method
        return new self;
    }
}