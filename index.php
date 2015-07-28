<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <title>Nye e-bøker på biblioteket</title>
    <link href='css/style.css' rel='stylesheet' type='text/css'> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jquery.mobile-events.js"></script>
    <script src="js/scripts.js"></script>
<?php
function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

function is_empty($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}
?>
</head>
<body>
<?php

// Innstillinger

$bibliotek = 'ullensaker';
$ccl = 'ff=la';

// CCL-eksempler
// 'ff=la og ag=mu' E-bøker for ungdom
// 'plass=dark romance' Dark romance


$rssurl = 'http://www.'. $bibliotek .'.folkebibl.no/cgi-bin/rss?bibxml=1&ccl='.urlencode($ccl);
$rssxml = simplexml_load_file($rssurl);
$rssxml->registerXPathNamespace('b', 'http://bibliofil.no/rss-xml-v1.2/');
$items = $rssxml->xpath('//item');
?>

<?php foreach ($items as $item) {
    $item->registerXPathNamespace('b', 'http://bibliofil.no/rss-xml-v1.2/');

    $ordord = $item->xpath('b:ordord');
    $forf = explode(", ",$ordord[0]);
    $forf = end($forf).' '.$forf[0];

    $tittel = $item->xpath('b:tittel');

    $krydderbilde = $item->xpath('b:krydderbilde_n'); // Bytt til $krydderbilde_x for høyere oppløsning

    $krydderbeskrivelse = $item->xpath('b:krydderbeskrivelse');
    $description = $item->description;
    if (!isset($krydderbeskrivelse[0]) || $krydderbeskrivelse[0] != '&nbsp;') {
        $beskrivelse = $krydderbeskrivelse[0];
    } else { 
        $beskrivelse = get_string_between($description, 'Sidetallet er hentet fra trykt utg.', '    ISBN ');
        $beskrivelse = trim($beskrivelse);
        $beskrivelse = explode("\n",$beskrivelse );
        foreach($beskrivelse as $arr) {
            $arr = trim($arr);
            if(
                !(substr( $arr, 0, 4 ) === "Har ") && 
                !(substr( $arr, 0, 6 ) === "Tekst ") && 
                !(substr( $arr, 0, 10 ) === "1. trykte ")
              ) {
                $output[] = $arr;
            }
        }
        $beskrivelse = implode(" ",$output);
        unset($output);
        
    };

    $titnr = $item->xpath('b:titnr');
    $pubdate = $item->pubdate;

    if (isset($krydderbilde[0]) and !empty($beskrivelse) ) {

 ?>

    <article class="item">
        <section class="image">
            <img src="<?php echo $krydderbilde[0]; ?>">
        </section>
        <section class="review">
            <h1><?php echo $tittel[0];?></h1>
            <?php if ($ordord[0] != '') {?><h2>av <?php echo $forf; ?></h2><?php };?>

            <div class="box">
                <p><?php echo $beskrivelse; ?></p>

            </div>
        </section>
    </article>

<?php } else { echo '<!--'. $tittel[0] .' mangler bilde eller beskrivelse.-->';}; ?>

<?php } ?>

</body>
</html>
