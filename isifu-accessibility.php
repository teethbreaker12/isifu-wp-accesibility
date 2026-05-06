<?php

/**
 * Plugin Name: Isifu Accessibility
 * Description: A customizable accessibility handler and widget for WordPress.
 * Version: 1.0.0
 * Author: Isifu
 * Text Domain: isifu-accessibility
 */

if (! defined('ABSPATH')) {
    exit;
}

define('ISIFU_ACCESSIBILITY_VERSION', '1.0.1');
define('ISIFU_ACCESSIBILITY_PATH', plugin_dir_path(__FILE__));
define('ISIFU_ACCESSIBILITY_URL', plugin_dir_url(__FILE__));

if (is_admin()) {
    require_once ISIFU_ACCESSIBILITY_PATH . 'includes/class-isifu-accessibility-settings.php';
}

class Isifu_Accessibility
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
        add_action('wp_footer', array($this, 'render_widget'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    public function enqueue_admin_assets($hook)
    {
        if ('settings_page_isifu-accessibility' !== $hook) {
            return;
        }
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style('isifu-accessibility-admin-style', ISIFU_ACCESSIBILITY_URL . 'assets/css/admin-style.css', array(), ISIFU_ACCESSIBILITY_VERSION);
    }

    public function enqueue_frontend_assets()
    {
        wp_enqueue_style('isifu-accessibility-frontend-style', ISIFU_ACCESSIBILITY_URL . 'assets/css/frontend-style.css', array(), ISIFU_ACCESSIBILITY_VERSION);
        wp_enqueue_style('isifu-accessibility-fixes-style', ISIFU_ACCESSIBILITY_URL . 'assets/css/accessibility-fixes.css', array(), ISIFU_ACCESSIBILITY_VERSION);
        wp_enqueue_script('isifu-accessibility-frontend-script', ISIFU_ACCESSIBILITY_URL . 'assets/js/frontend-script.js', array(), ISIFU_ACCESSIBILITY_VERSION, true);
    }

    public function render_widget()
    {
        $theme = get_option('isifu_acc_theme', 'dark');
        $accent_color = get_option('isifu_acc_accent_color', '#0284c7');
        $docs_url = get_option('isifu_acc_docs', '');
        $statement = get_option('isifu_acc_statement', '');
        $contact = get_option('isifu_acc_contact', '');

?>
        <style>
            :root {
                --isifu-accent: <?php echo esc_attr($accent_color); ?>;
            }
        </style>
        <div id="isifu-accessibility-overlay"></div>
        <div id="isifu-accessibility-app" class="isifu-theme-<?php echo esc_attr($theme); ?>">
            <button id="isifu-accessibility-trigger" aria-label="Open Accessibility Menu" aria-expanded="false">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m4.93 4.93 4.24 4.24"></path>
                    <path d="m14.83 9.17 4.24-4.24"></path>
                    <path d="m14.83 14.83 4.24 4.24"></path>
                    <path d="m9.17 14.83-4.24 4.24"></path>
                    <circle cx="12" cy="12" r="4"></circle>
                </svg>
            </button>

            <div id="isifu-accessibility-panel" role="dialog" aria-modal="true" aria-label="Accessibility Options" hidden>
                <div class="isifu-panel-header">
                    <h2>Ułatwienia dostępu</h2>
                    <div class="isifu-header-actions">
                        <button id="isifu-reset-btn" aria-label="Reset">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                            </svg>
                        </button>
                        <button id="isifu-close-panel" aria-label="Close Accessibility Menu">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="isifu-panel-content">
                    <div class="isifu-button-grid">
                        <?php
                        $this->render_grid_btn('invert-colors', 'Odwróć kolory', '<circle cx="12" cy="12" r="10"></circle><path d="M12 2v20a10 10 0 0 0 0-20z"></path>');
                        $this->render_grid_btn('monochrome', 'Monochromatyczny', '<circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>');
                        $this->render_grid_btn('dark-contrast', 'Ciemny kontrast', '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>');
                        $this->render_grid_btn('light-contrast', 'Jasny kontrast', '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>');
                        $this->render_grid_btn('low-saturation', 'Niskie nasycenie', '<circle cx="12" cy="12" r="10"></circle><path d="M8 12h8"></path>');
                        $this->render_grid_btn('high-saturation', 'Wysokie nasycenie', '<circle cx="12" cy="12" r="10"></circle><path d="M12 16v-8"></path>');
                        $this->render_grid_btn('highlight-links', 'Zaznacz linki', '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>');
                        $this->render_grid_btn('highlight-headings', 'Zaznacz nagłówki', '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><path d="M8 7v10"></path><path d="M12 7v10"></path><path d="M8 12h4"></path><path d="M16 8.5v8.5"></path><path d="M14.5 10.5L16 8.5"></path>');
                        ?>
                    </div>

                    <div class="isifu-slider-container">
                        <?php
                        $this->render_slider('content-scaling', 'Skalowanie treści', 100, 50, 200, 10, '%');
                        $this->render_slider('font-size', 'Czcionka', 100, 50, 200, 10, '%');
                        $this->render_slider('line-height', 'Wysokość linii', 100, 50, 200, 10, '%');
                        $this->render_slider('letter-spacing', 'Odstęp liter', 100, 0, 500, 10, '%');
                        ?>
                    </div>
                    <?php if (!empty($docs_url) || !empty($statement) || !empty($contact)) : ?>
                        <div class="isifu-footer-links">
                            <?php if (!empty($statement)) : ?>
                                <div class="isifu-statement"><?php echo esc_html($statement); ?></div>
                            <?php endif; ?>

                            <?php if (!empty($contact)) : ?>
                                <div class="isifu-contact"><?php echo wp_kses_post($contact); ?></div>
                            <?php endif; ?>

                            <?php if (!empty($docs_url)) : ?>
                                <a href="<?php echo esc_url($docs_url); ?>" class="isifu-docs-link isifu-btn-primary" target="_blank">Deklaracja dostępności</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="isifu-footer">
                        <p>made by: <a href="https://isifu.dev" target="_blank">isifu.dev</a></p>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    private function render_grid_btn($action, $label, $svg_content)
    {
    ?>
        <button class="isifu-grid-btn" data-action="<?php echo esc_attr($action); ?>">
            <span class="isifu-btn-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $svg_content; ?></svg>
            </span>
            <span><?php echo esc_html($label); ?></span>
        </button>
    <?php
    }

    private function render_slider($id, $label, $default, $min, $max, $step, $unit)
    {
    ?>
        <div class="isifu-slider-row">
            <div class="isifu-slider-label"><?php echo esc_html($label); ?></div>
            <div class="isifu-slider-custom-range">
                <div class="isifu-slider-track"></div>
                <input type="range" id="isifu-slider-<?php echo esc_attr($id); ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" step="<?php echo $step; ?>" value="<?php echo $default; ?>">
            </div>
            <div class="isifu-slider-value"><span id="isifu-val-<?php echo esc_attr($id); ?>"><?php echo $default; ?></span><?php echo $unit; ?></div>
            <div class="isifu-slider-actions">
                <button class="isifu-slider-btn isifu-slider-dec" data-target="<?php echo esc_attr($id); ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg></button>
                <button class="isifu-slider-btn isifu-slider-inc" data-target="<?php echo esc_attr($id); ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg></button>
            </div>
        </div>
<?php
    }
}

new Isifu_Accessibility();
