<?php
require "JARVIS.php";
require "settings.php";
require "Vorlesungen.php";

$CIS = new CIS(CIS_USERNAME, CIS_PASSWORD);
$Jarvis = new Jarvis(SLACK_CHANNELTEST, SLACK_CHANNEL);

if ($CIS->checkIfTodayVorlesungen(CIS_KALENDERURL)){
    $Vorlesungen = $CIS->getVorlesungen(CIS_KALENDERURL);
    $Jarvis->writeSlackMessage($Vorlesungen, true);
}
