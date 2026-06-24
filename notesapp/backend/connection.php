<?php

$connect = mysqli_connect('localhost', 'root', '', 'notes_app');

if (!$connect) {
    die("Unable to connect to the database");
}
