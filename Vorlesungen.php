<?php

class CIS
{
    const CONTEXT = "";

    public function __construct($username, $password)
    {
        $this->CONTEXT = stream_context_create(array(
            'http' => array(
                'header' => "Authorization: Basic " . base64_encode("$username:$password"),
            ),
        ));
    }

    public function checkIfTodayVorlesungen($kalenderurl)
    {
        $url = $kalenderurl;
        $kalender = file_get_contents($url, false, $this->CONTEXT);
        $kalenderlines = explode(",,,,,", $kalender);
        $heutigeVorlesungen = "";
        $VorlesungenCounter = 0;
        $VorlesungenHeute = false;

        for ($i = 1; $i < sizeof($kalenderlines); $i++) {
            $lineAsArray = explode(",", $kalenderlines[$i]);
            if (!isset($lineAsArray[7])) {
                continue;
            }

            $Datum = str_replace('"', '', $lineAsArray[7]);
            $TodaysDate = date('d.m.Y');

            if ($TodaysDate == $Datum) {

                return true;

            }
        }
        return false;
    }

    public function getVorlesungen($kalenderurl)
    {
        $url = $kalenderurl;
        $kalender = file_get_contents($url, false, $this->CONTEXT);
        $kalenderlines = explode(",,,,,", $kalender);
        $heutigeVorlesungen = "";
        $VorlesungenCounter = 0;

        for ($i = 1; $i < sizeof($kalenderlines); $i++) {
            $lineAsArray = explode(",", $kalenderlines[$i]);
            if (!isset($lineAsArray[7])) {
                continue;
            }

            $Datum = str_replace('"', '', $lineAsArray[7]);
            $TodaysDate = date('d.m.Y');

            if ($TodaysDate == $Datum) {
                $Raum = str_replace('"', '', explode("_", $lineAsArray[2])[1]);
                $Fach = str_replace('"', '', $lineAsArray[0]);
                $Start = str_replace('"', '', $lineAsArray[6]);
                $heutigeVorlesungen .= $Fach . " um " . $Start . " im Raum " . $Raum . "\n";
                $VorlesungenCounter++;

            }
        }

        if ($heutigeVorlesungen != "") {
            if ($VorlesungenCounter > 1) {
                $f_contents = file("IntroTextPlural.txt");
            } else {
                $f_contents = file("IntroTextSingular.txt");
            }

            $IntroText = $f_contents[array_rand($f_contents)] . "\n";

            return $IntroText . $heutigeVorlesungen;

        }

    }
}
