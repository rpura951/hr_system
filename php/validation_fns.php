<?php

function validate_ssn($ssn)
{
    if(!preg_match("/[0-9]{9}/",$ssn))
    {
        return false;
    }
    return true;
}

function validate_phone($phone)
{
    if(!preg_match("/[0-9]{10}/",$phone))
    {
        return false;
    }
    return true;
}

function validate_pw($pw)
{
    if(!preg_match("/[a-zA-Z0-9!@#$%^&*]{6,}/",$pw))
    {
        return false;
    }
    return true;
}

function validate_email($email)
{
    if(!preg_match("/([a-zA-Z0-9._]{3,})(@{1})([a-zA-Z]{2,})(\.{1})([a-zA-Z]{2,})(\.?)([a-zA-Z]{2,})?/",$email))
    {
        echo("Not working");
        return false;
    }
    else
        return true;
}
?>
