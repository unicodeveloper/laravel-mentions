<?php

if (!function_exists('mention')) {
    /**
     * Return an instance of the Mention FormBuilder.
     *
     * @return \Busayo\Mention\Factory\MentionBuilder
     */
    function mention()
    {
        return app('\Busayo\Mention\Factory\MentionBuilder');
    }
}
