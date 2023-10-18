<?php
function to_value($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function singleQuoteDuplicator($value)
{
    return str_replace("'", "''", $value);
}
function DoubleQuoteReducer($value)
{
    return str_replace("''", "'", $value);
}