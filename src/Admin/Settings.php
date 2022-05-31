<?php

namespace Hyperion\RestAPI\Admin;

class Settings
{
    public const SETTINGS_GROUP = 'restAPISettingsGroup';

    public static function createMenu()
    {
        //create new top-level menu
        add_menu_page('Configuration du plugin API',
            'Rest API',
            'manage_options',
            __DIR__ . "/SettingsPageView.php"
        );

        //call register settings function
        add_action('admin_init', ['\Hyperion\RestAPI\Admin\Settings', 'registerPluginSettings']);
    }

    public static function registerPluginSettings()
    {
        register_setting(self::SETTINGS_GROUP, \Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION);
    }

    public static function settingPage()
    {
        ?>
        <div class="wrap">
            <h1>REST API Plugin settings</h1>

            <form method="post" action="options.php">
                <?php settings_fields(Settings::SETTINGS_GROUP); ?>
                <?php do_settings_sections(Settings::SETTINGS_GROUP); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">API Namespace</th>
                        <td><input type="text" name="<?php echo \Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION; ?>"
                                   value="<?php echo esc_attr(get_option(\Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION)); ?>"/>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>

            </form>
        </div>
        <?php
    }
}