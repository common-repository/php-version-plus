jQuery(document).ready(function ($) {
	var displayErrors = "stderr";
	if (pvpObj.phpDisplayErrors == '1') {
		displayErrors = "On";
	} else if (pvpObj.phpDisplayErrors == '0') {
		displayErrors = "Off";
	}

	var logErrors = "Off";
	if (pvpObj.phpLogErrors == '1') {
		logErrors = "On";
	}

	$("#tnj-pvp-dashboard-info > .inside").html(
		"<strong class='header'>PHP Info:</strong>" +
		"<ul>" +
		"<li>Running PHP version: <strong>" + pvpObj.phpVersion + "</strong></li>" +
		"<li class='sub_header'>Resource Limits</li>" +
		"<li>Max execution time of each script: <strong>" + pvpObj.phpMaxExecutionTime + " seconds</strong></li>" +
		"<li>Max amount of time each script may spend parsing request data: <strong>" + pvpObj.phpMaxInputTime + " seconds</strong></li>" +
		"<li>Max amount of memory a script may consume: <strong>" + pvpObj.phpMemoryLimit + "</strong></li>" +
		"<li class='sub_header'>Error Handling and Logging</li>" +
		"<li>Display Errors: <strong>" + displayErrors + "</strong></li>" +
		"<li>Log Errors: <strong>" + logErrors + "</strong></li>" +
		"<li>Maximum length of Log Errors: <strong>" + pvpObj.phpLogErrorsMaxLen + "</strong></li>" +
		"<li class='sub_header'>Data Handling</li>" +
		"<li>Max allowed size for upload files: <strong>" + pvpObj.phpUploadMaxFilesize + "</strong></li>" +
		"<li class='sub_header'>File Uploads</li>" +
		"<li>Max size of POST data that PHP will accept: <strong>" + pvpObj.phpPostMaxSize + "</strong></li>" +
		"<li>Max number of files that can be uploaded via a single request: <strong>" + pvpObj.phpMaxFileUploads + "</strong></li>" +
		"</ul>" +
		"<strong class='header'>Wordpress Info:</strong><br>" +
		"<ul>" +
		"<li>Media max upload file size: <strong>" + pvpObj.wpMediaMaxUploadLimit + "</strong></li>" +
		"</ul>"
		);
});