<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>REST Server</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Hi there! 😁</h1>

	<div id="body">
		<p>Klik link dibawah untuk periksa apakah REST Server berfungsi. </p>
		<p>Hanya contoh, data dibawah tidak diambil dari DB</p>
		<ol>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users">Users</a> - defaulting to JSON</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/format/csv">Users</a> - get it in CSV</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/id/1">User #1</a> - defaulting to JSON  (users/id/1)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/1">User #1</a> - defaulting to JSON  (users/1)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/id/1.xml">User #1</a> - get it in XML (users/id/1.xml)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/id/1/format/xml">User #1</a> - get it in XML (users/id/1/format/xml)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/id/1?format=xml">User #1</a> - get it in XML (users/id/1?format=xml)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/1.xml">User #1</a> - get it in XML (users/1.xml)</li>
            <li><a id="ajax" href="https://api.umarhadi.xyz/index.php/api/example/users/format/json">Users</a> - get it in JSON (AJAX request)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users.html">Users</a> - get it in HTML (users.html)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users/format/html">Users</a> - get it in HTML (users/format/html)</li>
            <li><a href="https://api.umarhadi.xyz/index.php/api/example/users?format=html">Users</a> - get it in HTML (users?format=html)</li>
		</ol>
		<h3>Mau pindah? ke <a href="https://umarhadi.xyz">sini aja</a> atau ke <a href="https://blog.umarhadi.xyz">sini</a></h3>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. CodeIgniter Version <strong>4.0.4</strong></p>
</div>
<script src="https://code.jquery.com/jquery-1.12.0.js"></script>

<script>
    // Create an 'App' namespace
    var App = App || {};

    // Basic rest module using an IIFE as a way of enclosing private variables
    App.rest = (function restModule(window) {
        // Fields
        var _alert = window.alert;
        var _JSON = window.JSON;

        // Cache the jQuery selector
        var _$ajax = null;

        // Cache the jQuery object
        var $ = null;

        // Methods (private)

        /**
         * Called on Ajax done
         *
         * @return {undefined}
         */
        function _ajaxDone(data) {
            // The 'data' parameter is an array of objects that can be iterated over
            _alert(_JSON.stringify(data, null, 2));
        }

        /**
         * Called on Ajax fail
         *
         * @return {undefined}
         */
        function _ajaxFail() {
            _alert('Oh no! A problem with the Ajax request!');
        }

        /**
         * On Ajax request
         *
         * @param {jQuery} $element Current element selected
         * @return {undefined}
         */
        function _ajaxEvent($element) {
            $.ajax({
                    // URL from the link that was 'clicked' on
                    url: $element.attr('href')
                })
                .done(_ajaxDone)
                .fail(_ajaxFail);
        }

        /**
         * Bind events
         *
         * @return {undefined}
         */
        function _bindEvents() {
            // Namespace the 'click' event
            _$ajax.on('click.app.rest.module', function (event) {
                event.preventDefault();

                // Pass this to the Ajax event function
                _ajaxEvent($(this));
            });
        }

        /**
         * Cache the DOM node(s)
         *
         * @return {undefined}
         */
        function _cacheDom() {
            _$ajax = $('#ajax');
        }

        // Public API
        return {
            /**
             * Initialise the following module
             *
             * @param {object} jQuery Reference to jQuery
             * @return {undefined}
             */
            init: function init(jQuery) {
                $ = jQuery;

                // Cache the DOM and bind event(s)
                _cacheDom();
                _bindEvents();
            }
        };
    }(window));

    // DOM ready event
    $(function domReady($) {
        // Initialise the App module
        App.rest.init($);
    });
</script>

</body>
</html>