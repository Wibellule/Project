<?PHP
/**
 * @desc    Simple example to demonstrate how to use the Ini-Reader/Writer-Class.
 * @author  BennyZaminga <bzaminga@web.de>
 * @date    Sat Jul 03 23:59:57 CEST 2004
 * @version 0.01 
 */

// inlclude the class-file
require_once( 'class.ConfigMagik.php');

// create new ConfigMagik-Object
$Config = new ConfigMagik( 'example.ini', true, true);

// change path or name of config-file
#$Config->PATH             = "example.ini.php";

// switch processing sections on or off
// NOTE: Turning off section-processing while there are some sections defined, 
//       will lead to an error, so be careful with this one. This is due to the 
//       fact that in a ini-file it is not allowed to set key/value-pairs outside 
//       of a section when there is min one section defined.
//		 This is automatically enabled when a section is defined.
#$Config->PROCESS_SECTIONS = false;

// switch Protected-Mode on or off
// NOTE: It's always good practice when dealing with text-files (like ini's are) 
//       that hold sensitive data to protect them from beeing directly accessed.
//       This can be archieved in many ways, but the most simple of them all is 
//       just by naming them something like ´ini.mainConf.php´ and by leaving the 
//       Protected-Mode-Switch below enabled ;)
//       This is enabled by default.
#$Config->PROTECTED_MODE   = false;

// switch Synchronisation between Object and Ini-File on or off
// NOTE: In some cases ( ConfigurationPanel, Admin-Settings, etc.) it can be 
//       very useful to have this class saving the values to the file auto-
//       matically on each change.
//       This is enabled by default.
$Config->SYNCHRONIZE      = false;

// set a key named 'Name' with value 'SomeOne' in section 'second_section'
$Config->set( 'Name', 'SomeOne', 'second_section');

// get value from current config
$name = $Config->get( 'Name', 'second_section');
echo "<p>Name: " . $name . "</p>\n";

// remove a key/value-pair from section
$Config->removeKey( 'Name', 'second_section');

// remove entire section
$Config->removeSection( 'first_section');

// print-out ConfigMagik-Object
print_r( $Config);
?>