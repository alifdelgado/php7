<?php

function redirectTo(string $url = "/")
{
    header("Location: {$url}");
}

function setUserSession(array $data)
{
    $_SESSION['email'] = $data['email'];
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
}