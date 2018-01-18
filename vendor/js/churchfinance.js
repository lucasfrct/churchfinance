var $ofert = { value : 0, };

function dispatch (  $data = null, $fn = null ) {
			
	var $ajax = $.ajax( {
		method: "POST",
		url: "index.php",
		data: $data,
	} );

	$ajax.done ( function ( $data ) {
		if ( $fn ) {
			$fn ( $data );
		};
	} );	
};

function getOfert ( $value ) {
	$ofert.value = $value;
};

function addOfert ( ) {
	$data = { action: "create", table:"churchfinance.operations", data: { value: "11" } };
	dispatch ( $data, function ( $data ) {
		alert ($data);
	} );
};