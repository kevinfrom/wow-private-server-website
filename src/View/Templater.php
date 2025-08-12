<?php

declare(strict_types=1);

namespace App\View;

use ArrayObject;
use RuntimeException;

final readonly class Templater
{
    public function __construct(
        protected string $templatesDir = TEMPLATES_DIR,
        protected ArrayObject $globalData = new ArrayObject()
    ) {
        if (!file_exists($this->templatesDir)) {
            throw new RuntimeException("Templates directory does not exist: $this->templatesDir");
        }
    }

    protected function render(string $templatePath, array $data = []): string
    {
        if (!file_exists($templatePath)) {
            throw new RuntimeException("Template file not found: $templatePath");
        }

        extract($this->globalData->getArrayCopy());
        extract($data);
        ob_start();
        require $templatePath;

        return ob_get_clean();
    }

    public function template(string $template, array $data = []): string
    {
        $templatePath = $this->templatesDir . DS . "$template.php";

        foreach ($data as $key => $value) {
            $this->globalData->offsetSet($key, $value);
        }

        return $this->render($templatePath, $data);
    }

    public function element(string $element, array $data = []): string
    {
        $elementPath = $this->templatesDir . DS . 'elements' . DS . "$element.php";

        return $this->render($elementPath, $data);
    }
}
