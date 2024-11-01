=== Plugin Name ===
Contributors: Alton Crossley
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=URGKJSJ57L6JL
Tags: authentication, session, PHP
Requires at least: 2.6
Tested up to: 3.3.1
Stable tag: 0.2.1

Places user information in the global session for use in other applications on the same domain.  Currently used by a Crossley Framework (http://bit.ly/18hJsP) Auth module.  May require WP and app be installed on the same server.

== Description ==

Places user information in the global session for use in other applications on the same domain.  Currently used by a Crossley Framework (http://bit.ly/18hJsP) Auth module.  When used, a unauthenticated user can request an application page outside WP that requires authentication.  The module then forwards teh person to the WP Login page, which once authentication is finished, forwards the user back to the initial requested page.  Then the application can peer into who the user is as far as WP is concerned and decide what to do from there.

== Installation ==

Simply place this directory within your wp-content/plugins directory.  Then login to your WP Admin and activate the plugin on the plugin page.  This will make the current users login informaiton available through the session variable.


