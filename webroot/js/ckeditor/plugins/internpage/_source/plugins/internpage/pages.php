<?PHP

header('Content-type: application/javascript');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0, false');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');

/*
    The Example read files of a directory and outputs
    a javascript array. Output is:
   
    var InternPagesSelectBox = new Array(
        new Array( empty, empty ),
        new Array( name, link ),
        new Array( name, link )...
    );
   
    InternPagesSelectBox will loaded as select options
    to internpage plugin.
*/

$directory = $server_path."/pages";
$handle = opendir ($directory);

echo "var InternPagesSelectBox = new Array( new Array( '', '' )";
while (false !== ($file = readdir ($handle))) {
    if ( $file != "." && $file != ".." )
        echo ", new Array( '".$file."', 'index.php?page=".$file."' )";
}
echo " );\n";

closedir($handle);

?>
