<?php
	// Create PhpImap\Mailbox instance for all further actions
	$mailbox = new PhpImap\Mailbox(
		'{imap.gmail.com:993/imap/ssl}INBOX', // IMAP server and mailbox folder
		'tumail987654321@gmail.com', // Username for the before configured mailbox
		'9a8b7c6d', // Password for the before configured username
		__DIR__, // Directory, where attachments will be saved (optional)
		'UTF-8' // Server encoding (optional)
	);

	try {
		// Get all emails (messages)
		// PHP.net imap_search criteria: http://php.net/manual/en/function.imap-search.php
		$mailsIds = $mailbox->searchMailbox('ALL');
	} catch(PhpImap\Exceptions\ConnectionException $ex) {
		echo "IMAP connection failed: " . $ex;
		die();
	}

	// If $mailsIds is empty, no emails could be found
	if(!$mailsIds) {
		die('Mailbox is empty');
	}

	// Get the first message
	// If '__DIR__' was defined in the first line, it will automatically
	// save all attachments to the specified directory
	$mail = $mailbox->getMail($mailsIds[0]);

	// Show, if $mail has one or more attachments
	echo "\nMail has attachments? ";
	if($mail->hasAttachments()) {
		echo "Yes\n";
	} else {
		echo "No\n";
	}

	// Print all information of $mail
	print_r($mail);

	// Print all attachements of $mail
	echo "\n\nAttachments:\n";
	print_r($mail->getAttachments());
?>