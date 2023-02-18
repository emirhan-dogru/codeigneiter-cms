<?php

function seo($data)
{
    $turkce = ['ç', 'Ç', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'ı', 'İ', 'ş', 'Ş', '.', ',', '!', "'", "\"", " ", '?', '*', '_', '|', '=', '(', ')', '[', ']', '{', '}'];
    $convert = ['c', 'c', 'g', 'g', 'u', 'u', 'o', 'o', 'i', 'i', 's', 's', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'];
    return strtolower(str_replace($turkce, $convert, $data));
}


function get_active_user()
{
    $t = &get_instance();

    $user = $t->session->userdata('user');

    if ($user) {
        return $user;
    } else {
        return false;
    }
}
