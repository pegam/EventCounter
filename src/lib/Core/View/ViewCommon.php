<?php

namespace Core\View;

use Core\Formatter\FormatterInterface;

/**
 * Class ViewCommon
 *
 * @package Core\View
 */
abstract class ViewCommon implements ViewInterface {

    /** @var mixed */
    protected $rawContent;

    /** @var FormatterInterface */
    protected $formatter;

    /**
     * ViewCommon constructor.
     *
     * @param mixed $rawContent
     * @param FormatterInterface|null $formatter
     */
    public function __construct($rawContent, FormatterInterface $formatter = null) {
        $this->rawContent = $rawContent;
        if (null === $formatter) {
            $formatter = $this->createDefaultFormatter();
        }
        $this->formatter = $formatter;
    }

    /**
     * @return FormatterInterface
     */
    abstract protected function createDefaultFormatter();

    /**
     * @return string
     */
    public function getContent() {
        $content = $this->formatter->format($this->rawContent);
        return $content;
    }

}