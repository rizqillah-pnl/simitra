<?php
function validasi($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    // $data = str_replace("\n", "\~n", $data);
    $data = htmlspecialchars($data);

    return $data;
}
