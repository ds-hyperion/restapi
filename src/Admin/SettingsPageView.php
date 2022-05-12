<div class="wrap">
    <h1>REST API Plugin settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields( Hyperion\RestAPI\Admin\Settings::SETTINGS_GROUP ); ?>
        <?php do_settings_sections( Hyperion\RestAPI\Admin\Settings::SETTINGS_GROUP ); ?>
        <table class="form-table">
            <tr>
                <th scope="row">API Namespace</th>
                <td><input type="text" name="<?php echo \Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION; ?>" value="<?php echo esc_attr( get_option(\Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION) ); ?>" /></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>