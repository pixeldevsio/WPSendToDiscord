function send_message_to_discord( $message = 'undefined' ) {
	
	// get your webhook URL from Discord
	$url = 'https://discordapp.com/api/webhooks/your-webhook-id-here';
	$currentDate = date("l F dS Y h:i:sa", current_time( 'timestamp', 0 ));
	
	$data = array(
		'content' => $message . ' - ' . $currentDate
	);

	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-Type: application/json",
	        'method'  => 'POST',
	        'content' => json_encode($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

}
add_action( 'wp_ajax_discord_message', 'send_message_to_discord' );
add_action( 'wp_ajax_nopriv_discord_message', 'send_message_to_discord' );
