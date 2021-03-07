<?php
	$request=$_REQUEST;
	$name=htmlentities($request['name']);
	$email=htmlentities($request['email']);
	$body=htmlentities($request['body']);
