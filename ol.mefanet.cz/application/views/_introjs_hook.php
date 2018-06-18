<?php
include_once("iplib.php");
$filter = new IPFilter( array(
      '.....',   // add to IP adress to filter
));

if ($filter->check($_SERVER["REMOTE_ADDR"]) === true):
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/intro.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/introjs.min.css" />

<?php
/**
 * rozsireni o intro.js guided tour, polozky se nacitaji z externi db
 */

$config["db_server"] = "localhost";
$config["db_name"] = "adddbname";
$config["db_user"] = "adddbuser";
$config["db_user_pw"] = "addyourpassword";

$spojeni = mysqli_connect($config["db_server"], $config["db_user"], $config["db_user_pw"], $config["db_name"]) or die(mysqli_error($spojeni));
mysqli_query($spojeni, "SET character_set_results=utf8");
mysqli_query($spojeni, "SET character_set_connection=utf8");
mysqli_query($spojeni, "SET character_set_client=utf8");


//var_dump($_SERVER["REQUEST_URI"]);
/*
  ["QUERY_STRING"]=>
  string(0) ""
  ["REQUEST_URI"]=>
  string(1) "/"
  ["SCRIPT_NAME"]=>
  string(10) "/index.php"
  ["PHP_SELF"]=>
  string(10) "/index.php"
 */
$url_pcs = @explode("/", $_SERVER["REQUEST_URI"]);
if (!empty($url_pcs[1])) $url_mask = $url_pcs[1];
if (!empty($url_pcs[2])) $url_mask = "/" . $url_pcs[2]; // radeji bez uvodniho a koncoveho lomitka
if (empty($url_mask)) $url_mask = "*";

//echo "self .." . $_SERVER["REQUEST_URI"]; // $_SERVER["PHP_SELF"];
//$q = "SELECT * FROM item WHERE active=1 AND url_mask=" . mysqli_real_escape_string($spojeni, $_SERVER["REQUEST_URI"]) . " ORDER BY priority";
$q = "SELECT * FROM item WHERE active=1 AND url_mask LIKE '%" . $url_mask . "%' ORDER BY priority";

//var_dump($q);
$result01 = mysqli_query($spojeni, $q); //  || mysqli_error($spojeni)
//var_dump(mysqli_error($spojeni));
if (!mysqli_error($spojeni)) {
    //var_dump("SELECT * FROM item WHERE active=1 AND url_mask=" . mysqli_real_escape_string($spojeni, $_SERVER["REQUEST_URI"]) . " ORDER BY priority");
    //var_dump(mysqli_error($spojeni));
    $js_string = "";
    while ($item = mysqli_fetch_assoc($result01)) {
        $js_string .= "{\n";
        if ($item["selector_index"]) $js_string .= "  element: document.querySelectorAll('" . $item["selector"] . "')[" . $item["selector_index"] . "]";
        else $js_string .= "  element: document.querySelector('" . $item["selector"] . "')";
        $js_string .= ",\n";
        if (!empty($item["position"])) $js_string .= "  position: \"" . $item["position"] . "\",\n";
        $js_string .= "  intro: \"" . $item["content"] . "\"\n";
        $js_string .= "},";
    }
}

if (!empty($js_string)) :
?>

<p style="text-align: center"><a class="btn btn-success" href="javascript:void(0);" onclick="startIntro();">Start guided tour</a></p>
<script>
    //   introJs().start();
    //  introJs().addHints();
    function startIntro(){
        var intro = introJs();
        intro.setOptions({
            steps: [
                <?php echo substr($js_string, 0, -1)?>
            ]
        });
        intro.start();
    }
</script>
<?php
endif;

endif;