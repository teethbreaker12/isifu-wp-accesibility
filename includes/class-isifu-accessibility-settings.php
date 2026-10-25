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
        // Allow editors to save settings for this specific group.
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
        register_setting('isifu_accessibility_group', 'isifu_acc_default_lang', array($this, 'sanitize_default_language'));
        register_setting('isifu_accessibility_group', 'isifu_acc_enabled_langs', array($this, 'sanitize_enabled_languages'));
        register_setting('isifu_accessibility_group', 'isifu_acc_translations', array($this, 'sanitize_translations'));

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
            'Fallback Footer Statement',
            array($this, 'statement_callback'),
            'isifu-accessibility',
            'isifu_setting_section_content'
        );

        add_settings_field(
            'isifu_acc_docs',
            'Fallback Digital Accessibility Docs (URL)',
            array($this, 'docs_callback'),
            'isifu-accessibility',
            'isifu_setting_section_content'
        );

        add_settings_field(
            'isifu_acc_contact',
            'Fallback Contact Person',
            array($this, 'contact_callback'),
            'isifu-accessibility',
            'isifu_setting_section_content'
        );

        add_settings_section(
            'isifu_setting_section_languages',
            'Languages',
            array($this, 'languages_section_info'),
            'isifu-accessibility'
        );

        add_settings_field(
            'isifu_acc_default_lang',
            'Default Language',
            array($this, 'default_language_callback'),
            'isifu-accessibility',
            'isifu_setting_section_languages'
        );

        add_settings_field(
            'isifu_acc_enabled_langs',
            'Enabled Language Codes',
            array($this, 'enabled_languages_callback'),
            'isifu-accessibility',
            'isifu_setting_section_languages'
        );

        add_settings_field(
            'isifu_acc_autofill_translations',
            'Auto-fill Translations',
            array($this, 'autofill_callback'),
            'isifu-accessibility',
            'isifu_setting_section_languages'
        );

        add_settings_field(
            'isifu_acc_translations',
            'Manual Translations',
            array($this, 'translations_callback'),
            'isifu-accessibility',
            'isifu_setting_section_languages'
        );
    }

    public function section_info()
    {
        echo 'Configure the appearance of the accessibility widget.';
    }

    public function section_info2()
    {
        echo 'Fallback content is used when a selected language does not provide its own statement, docs URL, or contact text.';
    }

    public function languages_section_info()
    {
        echo 'The widget reads <code>?lang=xx</code> from the URL, for example <code>?lang=pl</code> for Polish. If the query language is missing or disabled, the default language below is used.';
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

    public function default_language_callback()
    {
        $enabled_languages = Isifu_Accessibility_I18n::get_enabled_languages();
        $default_language = Isifu_Accessibility_I18n::get_default_language();
    ?>
        <select id="isifu_acc_default_lang" name="isifu_acc_default_lang">
            <?php foreach ($enabled_languages as $code) : ?>
                <option value="<?php echo esc_attr($code); ?>" <?php selected($default_language, $code); ?>>
                    <?php echo esc_html(Isifu_Accessibility_I18n::language_label($code)); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description">Used when the URL does not include a supported <code>?lang=xx</code> query value.</p>
    <?php
    }

    public function enabled_languages_callback()
    {
        $enabled_languages = Isifu_Accessibility_I18n::get_enabled_languages();
    ?>
        <textarea id="isifu_acc_enabled_langs" name="isifu_acc_enabled_langs" rows="4" cols="24"><?php echo esc_textarea(implode("\n", $enabled_languages)); ?></textarea>
        <p class="description">Add one language code per line, such as <code>pl</code>, <code>en</code>, <code>de</code>, <code>es</code>, <code>fr</code>, <code>it</code>, or <code>nl</code>. Save once after adding a new code to show its manual translation fields.</p>
    <?php
    }

    public function autofill_callback()
    {
    ?>
        <label>
            <input type="checkbox" id="isifu_acc_autofill_translations" name="isifu_acc_autofill_translations" value="1" />
            Fill empty values from built-in presets on save.
        </label>
        <p class="description">Presets are available for Polish, English, German, Spanish, French, Italian, and Dutch. You can still override every value manually.</p>
    <?php
    }

    public function translations_callback()
    {
        $enabled_languages = Isifu_Accessibility_I18n::get_enabled_languages();
        $translations = Isifu_Accessibility_I18n::get_translations();
        $fields = Isifu_Accessibility_I18n::fields();
        $presets = Isifu_Accessibility_I18n::presets();
    ?>
        <div class="isifu-language-translations">
            <?php foreach ($enabled_languages as $code) : ?>
                <?php
                $language_values = isset($translations[$code]) && is_array($translations[$code]) ? $translations[$code] : array();
                $language_values = array_merge(isset($presets[$code]) ? $presets[$code] : array(), $language_values);
                ?>
                <details class="isifu-language-panel" open>
                    <summary>
                        <strong><?php echo esc_html(Isifu_Accessibility_I18n::language_label($code)); ?></strong>
                        <?php if (isset($presets[$code])) : ?>
                            <button type="button" class="button isifu-fill-language" data-language="<?php echo esc_attr($code); ?>">Fill preset</button>
                        <?php endif; ?>
                    </summary>
                    <div class="isifu-language-grid" data-language="<?php echo esc_attr($code); ?>">
                        <?php foreach ($fields as $key => $field) : ?>
                            <?php $value = isset($language_values[$key]) ? $language_values[$key] : ''; ?>
                            <label class="isifu-language-field">
                                <span><?php echo esc_html($field['label']); ?></span>
                                <?php if ('textarea' === $field['type']) : ?>
                                    <textarea name="isifu_acc_translations[<?php echo esc_attr($code); ?>][<?php echo esc_attr($key); ?>]" data-key="<?php echo esc_attr($key); ?>" rows="3"><?php echo esc_textarea($value); ?></textarea>
                                <?php elseif ('html' === $field['type']) : ?>
                                    <textarea name="isifu_acc_translations[<?php echo esc_attr($code); ?>][<?php echo esc_attr($key); ?>]" data-key="<?php echo esc_attr($key); ?>" rows="3"><?php echo esc_textarea($value); ?></textarea>
                                    <small>Basic HTML is allowed.</small>
                                <?php else : ?>
                                    <input type="<?php echo 'url' === $field['type'] ? 'url' : 'text'; ?>" name="isifu_acc_translations[<?php echo esc_attr($code); ?>][<?php echo esc_attr($key); ?>]" data-key="<?php echo esc_attr($key); ?>" value="<?php echo 'url' === $field['type'] ? esc_url($value) : esc_attr($value); ?>" />
                                <?php endif; ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
        <script>
            window.isifuAccessibilityPresets = <?php echo wp_json_encode($presets); ?>;
            jQuery(function($) {
                $('.isifu-fill-language').on('click', function() {
                    var language = $(this).data('language');
                    var preset = window.isifuAccessibilityPresets[language] || {};

                    $(this).closest('.isifu-language-panel').find('[data-key]').each(function() {
                        var key = $(this).data('key');
                        if (preset[key] !== undefined) {
                            $(this).val(preset[key]);
                        }
                    });
                });
            });
        </script>
    <?php
    }

    public function sanitize_default_language($input)
    {
        $code = Isifu_Accessibility_I18n::normalize_language_code($input);
        return $code ? $code : 'pl';
    }

    public function sanitize_enabled_languages($input)
    {
        $languages = is_array($input) ? $input : preg_split('/[\s,]+/', (string) $input);
        $normalized = array();

        foreach ($languages as $language) {
            $code = Isifu_Accessibility_I18n::normalize_language_code($language);
            if ($code && ! in_array($code, $normalized, true)) {
                $normalized[] = $code;
            }
        }

        if (isset($_POST['isifu_acc_default_lang'])) {
            $default = Isifu_Accessibility_I18n::normalize_language_code(wp_unslash($_POST['isifu_acc_default_lang']));
            if ($default && ! in_array($default, $normalized, true)) {
                array_unshift($normalized, $default);
            }
        }

        return $normalized ? $normalized : array('pl');
    }

    public function sanitize_translations($input)
    {
        $fields = Isifu_Accessibility_I18n::fields();
        $presets = Isifu_Accessibility_I18n::presets();
        $languages_input = isset($_POST['isifu_acc_enabled_langs']) ? wp_unslash($_POST['isifu_acc_enabled_langs']) : get_option('isifu_acc_enabled_langs', array('pl', 'en'));
        $enabled_languages = $this->sanitize_enabled_languages($languages_input);
        $autofill = ! empty($_POST['isifu_acc_autofill_translations']);
        $output = array();

        if (! is_array($input)) {
            $input = array();
        }

        foreach ($enabled_languages as $code) {
            $posted_language = isset($input[$code]) && is_array($input[$code]) ? $input[$code] : array();
            $output[$code] = array();

            foreach ($fields as $key => $field) {
                $value = isset($posted_language[$key]) ? wp_unslash($posted_language[$key]) : '';
                if (is_array($value)) {
                    $value = '';
                }

                if ('' === trim((string) $value) && $autofill && isset($presets[$code][$key])) {
                    $value = $presets[$code][$key];
                }

                if ('html' === $field['type']) {
                    $output[$code][$key] = wp_kses_post($value);
                } elseif ('url' === $field['type']) {
                    $output[$code][$key] = esc_url_raw($value);
                } elseif ('textarea' === $field['type']) {
                    $output[$code][$key] = sanitize_textarea_field($value);
                } else {
                    $output[$code][$key] = sanitize_text_field($value);
                }
            }
        }

        return $output;
    }
}

if (is_admin()) {
    new Isifu_Accessibility_Settings();
}
