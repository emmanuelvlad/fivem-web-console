<?php
if (!isset($_POST['data']))
  die('nope');

require "config.php";
require "rcon.php";

$command = $_POST['data'];

$rcon = new q3query($address, $port, $success);
if (!$success) {
  die ("oho, not good");
}
$rcon->setRconpassword($rcon_password);
$rcon->rcon("$command");
$rcon->close();

?>
