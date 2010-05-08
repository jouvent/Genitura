<?php
function format_error($errors)
{
    $formated_errors = array();
    foreach($errors as $field => $field_errors)
    {
        $fliped = array_flip($field_errors);
        foreach($fliped as $key=>$value)
        {
            $fliped[$key] = 1;
        }
        $formated_errors[$field] = $fliped;
    }
    return $formated_errors;
}

function get_errors($record)
{
    $record->isValid();
    return format_error($record->getErrorStack()->toArray()); 
}
