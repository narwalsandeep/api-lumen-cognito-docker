<?php

namespace App\Http\Controllers;

class Constants
{
	const SUCC_LOADED_SUCCESSFULLY = "Loaded successfully";
	const SUCC_CREATED_SUCCESSFULLY = "Created successfully";
	const SUCC_UPDATED_SUCCESSFULLY = "Updated successfully";
	const SUCC_DELETED_SUCCESSFULLY = "Deleted successfully";

	const ERR_UNKNOWN_ERROR = "Unknown error, please try again";

	const ERR_USER_NOT_FOUND = "Username not found";
	const ERR_INVALID_TOKEN = "Invalid Token";
	const ERR_USER_EXISTS = "Username already exists";
	const ERR_CHECK_USERNAME_OR_PASSWORD = "Username/Email or Password are not in valid format";
	const ERR_INVALID_USER_PWD = "Invalid Username or Password";
	const ERR_INVALID_VERIFICATION_CODE = "Invalid verification code";
	const ERR_USER_NOT_VERIFIED = "Username invalid or not verified";
	const ERR_INVALID_DATA = "Invalid data provided";
	

}
