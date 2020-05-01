<?php

function validate_ssn($ssn)
{
    if(!preg_match("[0-9]{9}"))
    {
        return false;
    }
    return true;
}

function validate_phone($phone)
{
    if(!preg_match("[0-9]{10}"))
    {
        return false;
    }
    return true;
}

function verify_pw($pw)
{
    if(!preg_match("[a-zA-Z0-9]{6,}"))
    {
        return false;
    }
    return true;
}

?>