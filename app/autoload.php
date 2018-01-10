<?php 
spl_autoload_register ( function ( $className ) {
    
    $file = str_replace ( "\\", "/", $className . ".php" );
    
    if ( file_exists ( $file ) ) {
    	echo "Auto --: ".$file."<br>";
    	require_once ( $file );
	};
} );