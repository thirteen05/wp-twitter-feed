<div class="wrap">
<h2>Twitter1305 Custom Twitter Feed</h2>

<h3>API Settings</h3>
<form method="post" action="options.php">
    <?php settings_fields( 'twitter1305-settings-group' ); ?>
    <?php do_settings_sections( 'twitter1305-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Twitter API Key</th>
        <td><input class="twitter1305-input" type="text" name="twitterAPI" value="<?php echo esc_attr( get_option('twitterAPI') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Twitter API Secret</th>
        <td><input class="twitter1305-input" type="text" name="twitterSecret" value="<?php echo esc_attr( get_option('twitterSecret') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Twitter Handle</th>
        <td><input class="twitter1305-input" type="text" name="twitterHandle" value="<?php echo esc_attr( get_option('twitterHandle') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Number of Tweets</th>
        <td>
        	<input class="twitter1305-input-number" type="number" name="tweetQuantity" value="<?php echo esc_attr( get_option('tweetQuantity') ); ?>" />
        	<p class="description">Select 0 to Display All Tweets</p>
        </td>
        </tr>

    </table>
    
    <?php submit_button(); ?>

</form>

<h3>Created by the crew at <a href="http://www.thirteen05.com">thirteen05 Creative</a></h3>
</div>