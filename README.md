Go-Gravatar - Gravatar integration for WP
===

A plugin to allow retrieval gravatar account info in WP.

Requirements
---
None.

Hacking
---
None. No additional actions or filters were added.

Usage
---
Get a profile object: `$profile = go_gravatar()->get_profile( $email )` where email is the email address of the user whose profile you want.


If you just want the image: `$gravatar = go_gravatar()->get_img( $email, $size, $default, $alt )`

Or just the image URL: `$url = go_gravatar()->get_img_url( $email, $size, $default', $alt )`. This calls `go_gravatar()->get_image()` but returns only the url.