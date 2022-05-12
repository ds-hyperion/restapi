<div class="wrap">
    <h1>REST API Plugin settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields( Hyperion\RestAPI\Admin\Settings::SETTINGS_GROUP ); ?>
        <?php do_settings_sections( Hyperion\RestAPI\Admin\Settings::SETTINGS_GROUP ); ?>
        <table class="form-table">
            <tr>
                <th scope="row">API Namespace</th>
                <td><input type="text" name="api_namespace" value="<?php echo esc_attr( get_option('api_namespace') ); ?>" /></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>