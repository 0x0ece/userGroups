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

	/**
	 * Enable compatibility mode
	 * It is strongly recommended to keep COMPAT_MODE=true ONLY for the time needed to all
	 * users to login and have their password rehashed
	 */
	const COMPAT_MODE = false;

	/**
	 * Algorithm used by PHP password hash
	 * It is strongly recommended to keep ALGO = PASSWORD_DEFAULT
	 */
	const ALGO = PASSWORD_DEFAULT;

	/**
	 * Hash a password
	 * @param password the password to be hashed.
	 * @param salt @deprecated the salt (PHP password hash does everything for us).
	 * @return hash, the hashed password.
	 */
	public static function password_hash($password, $salt = null)
	{
		return password_hash($password, self::ALGO);
	}

	/**
	 * Verify that $password (plain text) and $hash (from db) match.
	 *
	 * In COMPAT_MODE, it also checks for old-style md5-based hashed passwords.
	 *
	 * @param password the password, in plain text.
	 * @param hash, the hash stored in the db.
	 * @param salt @deprecated the salt (PHP password hash does everything for us).
	 * @return hash, the hashed password.
	 */
	public static function password_verify($password, $hash, $salt = null)
	{
		if (self::COMPAT_MODE && strlen($hash) == 32)
			return ($hash === md5($password . $salt));

		return password_verify($password, $hash);
	}

	/**
	 * Check if $hash needs to be rehashed, e.g. after changing ALGO 
	 * (or updating PHP in such a way that PASSWORD_DEFAULT is changed).
	 *
	 * In COMPAT_MODE, old-style md5-based hashed passwords ALWAYS need to be rehashed ;)
	 *
	 * @param hash, the hash to be checked.
	 * @return hash, the hashed password.
	 */
	public static function password_needs_rehash($hash)
	{
		if (self::COMPAT_MODE && strlen($hash) == 32)
			return true;

		return password_needs_rehash($hash, self::ALGO);
	}

}
