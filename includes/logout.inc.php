<?php

session_start(); // We need to start session in order to be able to destroy it
session_unset();
session_destroy();

header("location: ../index.php?error=none");