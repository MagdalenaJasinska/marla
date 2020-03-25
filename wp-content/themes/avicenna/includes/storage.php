<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('avicenna_storage_get')) {
	function avicenna_storage_get($var_name, $default='') {
		global $AVICENNA_STORAGE;
		return isset($AVICENNA_STORAGE[$var_name]) ? $AVICENNA_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('avicenna_storage_set')) {
	function avicenna_storage_set($var_name, $value) {
		global $AVICENNA_STORAGE;
		$AVICENNA_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('avicenna_storage_empty')) {
	function avicenna_storage_empty($var_name, $key='', $key2='') {
		global $AVICENNA_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($AVICENNA_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($AVICENNA_STORAGE[$var_name][$key]);
		else
			return empty($AVICENNA_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('avicenna_storage_isset')) {
	function avicenna_storage_isset($var_name, $key='', $key2='') {
		global $AVICENNA_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($AVICENNA_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($AVICENNA_STORAGE[$var_name][$key]);
		else
			return isset($AVICENNA_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('avicenna_storage_inc')) {
	function avicenna_storage_inc($var_name, $value=1) {
		global $AVICENNA_STORAGE;
		if (empty($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = 0;
		$AVICENNA_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('avicenna_storage_concat')) {
	function avicenna_storage_concat($var_name, $value) {
		global $AVICENNA_STORAGE;
		if (empty($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = '';
		$AVICENNA_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('avicenna_storage_get_array')) {
	function avicenna_storage_get_array($var_name, $key, $key2='', $default='') {
		global $AVICENNA_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($AVICENNA_STORAGE[$var_name][$key]) ? $AVICENNA_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($AVICENNA_STORAGE[$var_name][$key][$key2]) ? $AVICENNA_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('avicenna_storage_set_array')) {
	function avicenna_storage_set_array($var_name, $key, $value) {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if ($key==='')
			$AVICENNA_STORAGE[$var_name][] = $value;
		else
			$AVICENNA_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('avicenna_storage_set_array2')) {
	function avicenna_storage_set_array2($var_name, $key, $key2, $value) {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if (!isset($AVICENNA_STORAGE[$var_name][$key])) $AVICENNA_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$AVICENNA_STORAGE[$var_name][$key][] = $value;
		else
			$AVICENNA_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('avicenna_storage_merge_array')) {
	function avicenna_storage_merge_array($var_name, $key, $value) {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if ($key==='')
			$AVICENNA_STORAGE[$var_name] = array_merge($AVICENNA_STORAGE[$var_name], $value);
		else
			$AVICENNA_STORAGE[$var_name][$key] = array_merge($AVICENNA_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('avicenna_storage_set_array_after')) {
	function avicenna_storage_set_array_after($var_name, $after, $key, $value='') {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if (is_array($key))
			avicenna_array_insert_after($AVICENNA_STORAGE[$var_name], $after, $key);
		else
			avicenna_array_insert_after($AVICENNA_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('avicenna_storage_set_array_before')) {
	function avicenna_storage_set_array_before($var_name, $before, $key, $value='') {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if (is_array($key))
			avicenna_array_insert_before($AVICENNA_STORAGE[$var_name], $before, $key);
		else
			avicenna_array_insert_before($AVICENNA_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('avicenna_storage_push_array')) {
	function avicenna_storage_push_array($var_name, $key, $value) {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($AVICENNA_STORAGE[$var_name], $value);
		else {
			if (!isset($AVICENNA_STORAGE[$var_name][$key])) $AVICENNA_STORAGE[$var_name][$key] = array();
			array_push($AVICENNA_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('avicenna_storage_pop_array')) {
	function avicenna_storage_pop_array($var_name, $key='', $defa='') {
		global $AVICENNA_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($AVICENNA_STORAGE[$var_name]) && is_array($AVICENNA_STORAGE[$var_name]) && count($AVICENNA_STORAGE[$var_name]) > 0) 
				$rez = array_pop($AVICENNA_STORAGE[$var_name]);
		} else {
			if (isset($AVICENNA_STORAGE[$var_name][$key]) && is_array($AVICENNA_STORAGE[$var_name][$key]) && count($AVICENNA_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($AVICENNA_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('avicenna_storage_inc_array')) {
	function avicenna_storage_inc_array($var_name, $key, $value=1) {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if (empty($AVICENNA_STORAGE[$var_name][$key])) $AVICENNA_STORAGE[$var_name][$key] = 0;
		$AVICENNA_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('avicenna_storage_concat_array')) {
	function avicenna_storage_concat_array($var_name, $key, $value) {
		global $AVICENNA_STORAGE;
		if (!isset($AVICENNA_STORAGE[$var_name])) $AVICENNA_STORAGE[$var_name] = array();
		if (empty($AVICENNA_STORAGE[$var_name][$key])) $AVICENNA_STORAGE[$var_name][$key] = '';
		$AVICENNA_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('avicenna_storage_call_obj_method')) {
	function avicenna_storage_call_obj_method($var_name, $method, $param=null) {
		global $AVICENNA_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($AVICENNA_STORAGE[$var_name]) ? $AVICENNA_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($AVICENNA_STORAGE[$var_name]) ? $AVICENNA_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('avicenna_storage_get_obj_property')) {
	function avicenna_storage_get_obj_property($var_name, $prop, $default='') {
		global $AVICENNA_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($AVICENNA_STORAGE[$var_name]->$prop) ? $AVICENNA_STORAGE[$var_name]->$prop : $default;
	}
}
?>