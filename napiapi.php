<?php
define('BANK_SHORT_NAME', 'kh'); // see the list in the read me
define('BANK_NAME', 'K&H Bank Zrt.');
define('CRNY_OPT1', 'EUR');
define('CRNY_OPT2', 'USD');

$xml=simplexml_load_file('http://api.napiarfolyam.hu') or die("Error: Cannot create object");
if ($xml === FALSE) {
    echo "There were errors parsing the XML file.\n";
    foreach(libxml_get_errors() as $error) {
        echo $error->message;
    }
    exit;
}
$object = json_encode($xml);
$array = json_decode($object, TRUE);
$elem = $array['valuta']['item'];
foreach ($elem as $m) {
    if ($m['bank'] == BANK_SHORT_NAME) {
        if ($m['penznem'] == CRNY_OPT1) {
            $opt1buy = $m['vetel'];
            $opt1sell = $m['eladas'];
        }
        if ($m['penznem'] == CRNY_OPT2) {
            $opt2buy = $m['vetel'];
            $opt2sell = $m['eladas'];
        }
    }
}

echo BANK_NAME . '<br>';
echo CRNY_OPT1 . '<br>';
echo 'vetel: ' . $opt1buy . '<br>';
echo 'eladas: ' . $opt1sell . '<br>';
echo CRNY_OPT2 . '<br>';
echo 'vetel: ' . $opt2buy . '<br>';
echo 'eladas: ' . $opt2sell . '<br>';

?>
