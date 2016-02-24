<?php

namespace Unicodeveloper\Mention\Factory;

use Collective\Html\FormBuilder as FormBuilder;
use Collective\Html\HtmlBuilder as HtmlBuilder;
use Illuminate\Routing\UrlGenerator as UrlGenerator;
use Illuminate\Contracts\View\Factory as ViewFactory;

class MentionBuilder extends FormBuilder
{

    /**
     *  Create an instance of Mention builder and also call Form Builder's constructor
     * @param HtmlBuilder $html [description]
     * @param UrlGenerator $url [description]
     * @param ViewFactory $view [description]
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url, ViewFactory $view)
    {
        parent::__construct($html, $url, $view, csrf_token());
    }


    /**
     * Create a text input field.
     *
     * @param string $name
     * @param string $value
     * @param string $type
     * @param string $column
     * @param string $class
     *
     * @return string
     */
    public function asText($name, $value, $type, $column, $class = '')
    {

        $input = $this->text($name, $value, [
            'id' => 'mention-' . $name,
            'class' => $class
        ]);


$scriptTag = <<< EOT
    <script type="text/javascript">
        $(function(){
            enableMentions("#mention-$name", "$type", "$column");
        });
    </script>
EOT;

        return $scriptTag.$input;
    }

    /**
     * Create a textarea input field.
     *
     * @param string $name
     * @param string $value
     * @param string $type
     * @param string $column
     * @param string $class
     *
     * @return string
     */
    public function asTextArea($name, $value, $type, $column, $class = '')
    {
        $input = $this->textarea($name, $value, [
            'id' => 'mention-' . $name,
            'class' => $class
        ]);

$scriptTag = <<< EOT
    <script type="text/javascript">
        $(function(){
            enableMentions("#mention-$name", "$type", "$column");
        });
    </script>
EOT;

        return $scriptTag.$input;
    }
}
