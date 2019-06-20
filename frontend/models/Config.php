<?php
namespace app\models;

class Config {
	function Urlmap() {
		$key = "AIzaSyDM-VJ53keVzveifGvWs8IJ4ynRtHeuEwU";
		return "http://maps.google.com/maps/api/js?v=3&language=th&callback=initialize&key=" . $key;
	}
}