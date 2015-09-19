<?php

namespace Busayo\Mention\Factory;

use Collective\Html\FormBuilder as FormBuilder;
use Collective\Html\HtmlBuilder as HtmlBuilder;
use Illuminate\Routing\UrlGenerator as UrlGenerator;

class MentionBuilder extends FormBuilder
{

    /**
     *  Create an instance of Mention builder and also call Form Builder's constructor
     * @param HtmlBuilder  $html [description]
     * @param UrlGenerator $url  [description]
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url)
    {
        parent::__construct($html, $url, csrf_token());
    }


    /**
     * Create a text input field.
     *
     * @param string $name
     * @param string $value
     * @param string $type
     * @param string $column
     *
     * @return string
     */
    public function asText($name, $value, $type, $column)
    {

        $input = $this->text($name, $value, [
            'id' => 'mention-'.$name,
        ]);


        $scriptTag =

        '<script type="text/javascript">
            $(function(){
                enableMentions("#mention-'.$name.'", "'.$type.'", "'.$column.'");
            });
        </script>';

        return $scriptTag.$input;
    }

    /**
     * Create a textarea input field.
     *
     * @param string $name
     * @param string $value
     * @param string $type
     * @param string $column
     *
     * @return string
     */
    public function asTextArea($name, $value, $type, $column)
    {
        $input = $this->textarea($name, $value, [
            'id' => 'mention-'.$name,
        ]);

        $scriptTag =
        '<script type="text/javascript">
            $(function(){
                enableMentions("#mention-'.$name.'", "'.$type.'", "'.$column.'");
            });
        </script>';

        return $scriptTag.$input;
    }
}
