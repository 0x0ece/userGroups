<?php
/**
 * this file contains the UGPassword class
 * @author Emanuele Cesena <emanuele.cesena@gmail.com>
 * @package userGroups
 * @since 1.8
 */

/**
 * This class takes care of managing password hash, verification and rehashing.
 * It is inspired to the new password hash api in PHP5.5 (https://wiki.php.net/rfc/password_hash).
 * Salt is available for backward compatibility (and shall be deprecated).
 * @author Emanuele Cesena
 */
require('password_compat/lib/password.php');

class UGPassword {

	public static function password_hash($password, $salt = null)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}

	public static function password_verify($password, $hash, $salt = null)
	{
		return password_verify($password, $hash);
	}

	public static function password_needs_rehash($hash)
	{
		return password_needs_rehash($hash, PASSWORD_DEFAULT);
	}

}
