<?php

if (! defined('ABSPATH')) {
    exit;
}

class Isifu_Accessibility_Settings
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
        // Allow editors to save settings for this specific group
        add_filter('option_page_capability_isifu_accessibility_group', array($this, 'editor_capability'));
    }

    public function editor_capability($capability)
    {
        return 'edit_pages';
    }

    public function add_plugin_page()
    {
        add_management_page(
            'Accessibility Options',
            'Accessibility',
            'edit_pages',
            'isifu-accessibility',
            array($this, 'create_admin_page')
        );
    }

    public function create_admin_page()
    {
?>
        <div class="wrap isifu-accessibility-wrap">
            <h1>Isifu Accessibility Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('isifu_accessibility_group');
                do_settings_sections('isifu-accessibility');
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }

    public function page_init()
    {
        register_setting('isifu_accessibility_group', 'isifu_acc_theme');
        register_setting('isifu_accessibility_group', 'isifu_acc_accent_color');
        register_setting('isifu_accessibility_group', 'isifu_acc_docs');
        register_setting('isifu_accessibility_group', 'isifu_acc_contact');
        register_setting('isifu_accessibility_group', 'isifu_acc_statement');

        add_settings_section(
            'isifu_setting_section_primary',
            'General Settings',
            array($this, 'section_info'),
            'isifu-accessibility'
        );

        add_settings_field(
            'isifu_acc_theme',
            'Widget Theme',
            array($this, 'theme_callback'),
            'isifu-accessibility',
            'isifu_setting_section_primary'
        );

        add_settings_field(
            'isifu_acc_accent_color',
            'Accent Color',
            array($this, 'accent_color_callback'),
            'isifu-accessibility',
            'isifu_setting_section_primary'
        );

        add_settings_section(
            'isifu_setting_section_content',
            'Widget Content',
            array($this, 'section_info2'),
            'isifu-accessibility'
        );

        add_settings_field(
            'isifu_acc_statement',
            'Footer Statement',
            array($this, 'statement_callback'),
            'isifu-accessibility',
            'isifu_setting_section_content'
        );

        add_settings_field(
            'isifu_acc_docs',
            'Digital Accessibility Docs (URL)',
            array($this, 'docs_callback'),
            'isifu-accessibility',
            'isifu_setting_section_content'
        );

        add_settings_field(
            'isifu_acc_contact',
            'Contact Person',
            array($this, 'contact_callback'),
            'isifu-accessibility',
            'isifu_setting_section_content'
        );
    }

    public function section_info()
    {
        echo 'Configure the appearance of the accessibility widget.';
    }

    public function section_info2()
    {
        echo 'Provide necessary information and documentation texts.';
    }

    public function theme_callback()
    {
        $val = get_option('isifu_acc_theme', 'light');
    ?>
        <select id="isifu_acc_theme" name="isifu_acc_theme">
            <option value="light" <?php selected($val, 'light'); ?>>Light Mode</option>
            <option value="dark" <?php selected($val, 'dark'); ?>>Dark Mode</option>
        </select>
    <?php
    }

    public function accent_color_callback()
    {
        $val = get_option('isifu_acc_accent_color', '#111827');
    ?>
        <input type="text" id="isifu_acc_accent_color" name="isifu_acc_accent_color" value="<?php echo esc_attr($val); ?>" class="isifu-color-field" />
        <script>
            jQuery(document).ready(function($) {
                $('.isifu-color-field').wpColorPicker();
            });
        </script>
    <?php
    }

    public function statement_callback()
    {
        $val = get_option('isifu_acc_statement', 'This website strives to conform to WCAG 2.1 Level AA standards. If you encounter any accessibility barriers, please contact us.');
    ?>
        <textarea id="isifu_acc_statement" name="isifu_acc_statement" rows="3" cols="50"><?php echo esc_textarea($val); ?></textarea>
    <?php
    }

    public function docs_callback()
    {
        $val = get_option('isifu_acc_docs', '');
    ?>
        <input type="url" id="isifu_acc_docs" name="isifu_acc_docs" value="<?php echo esc_url($val); ?>" class="regular-text" placeholder="https://..." />
        <p class="description">Paste the URL link to the Digital Accessibility Declaration.</p>
<?php
    }

    public function contact_callback()
    {
        $val = get_option('isifu_acc_contact', '');
        wp_editor($val, 'isifu_acc_contact', array('textarea_rows' => 3));
    }
}

if (is_admin()) {
    new Isifu_Accessibility_Settings();
}
