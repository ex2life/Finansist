<?php
session_start();
require('./registration/lib/common.php');
echo get_current_user_id();
?>test