<?php

if (! defined('ABSPATH')) {
    exit;
}

class Isifu_Accessibility_I18n
{
    public static function fields()
    {
        return array(
            'trigger_aria' => array('label' => 'Trigger aria label', 'type' => 'text'),
            'panel_aria' => array('label' => 'Panel aria label', 'type' => 'text'),
            'panel_title' => array('label' => 'Panel title', 'type' => 'text'),
            'reset_aria' => array('label' => 'Reset aria label', 'type' => 'text'),
            'close_aria' => array('label' => 'Close aria label', 'type' => 'text'),
            'invert_colors' => array('label' => 'Invert colors button', 'type' => 'text'),
            'monochrome' => array('label' => 'Monochrome button', 'type' => 'text'),
            'dark_contrast' => array('label' => 'Dark contrast button', 'type' => 'text'),
            'light_contrast' => array('label' => 'Light contrast button', 'type' => 'text'),
            'low_saturation' => array('label' => 'Low saturation button', 'type' => 'text'),
            'high_saturation' => array('label' => 'High saturation button', 'type' => 'text'),
            'highlight_links' => array('label' => 'Highlight links button', 'type' => 'text'),
            'highlight_headings' => array('label' => 'Highlight headings button', 'type' => 'text'),
            'content_scaling' => array('label' => 'Content scaling slider', 'type' => 'text'),
            'font_size' => array('label' => 'Font size slider', 'type' => 'text'),
            'line_height' => array('label' => 'Line height slider', 'type' => 'text'),
            'letter_spacing' => array('label' => 'Letter spacing slider', 'type' => 'text'),
            'docs_link_label' => array('label' => 'Accessibility declaration link label', 'type' => 'text'),
            'made_by_label' => array('label' => 'Footer credit label', 'type' => 'text'),
            'statement' => array('label' => 'Footer statement', 'type' => 'textarea'),
            'docs_url' => array('label' => 'Digital accessibility docs URL', 'type' => 'url'),
            'contact' => array('label' => 'Contact person', 'type' => 'html'),
        );
    }

    public static function presets()
    {
        return array(
            'pl' => array(
                'trigger_aria' => 'Otwórz menu ułatwień dostępu',
                'panel_aria' => 'Opcje ułatwień dostępu',
                'panel_title' => 'Ułatwienia dostępu',
                'reset_aria' => 'Resetuj',
                'close_aria' => 'Zamknij menu ułatwień dostępu',
                'invert_colors' => 'Odwróć kolory',
                'monochrome' => 'Monochromatyczny',
                'dark_contrast' => 'Ciemny kontrast',
                'light_contrast' => 'Jasny kontrast',
                'low_saturation' => 'Niskie nasycenie',
                'high_saturation' => 'Wysokie nasycenie',
                'highlight_links' => 'Zaznacz linki',
                'highlight_headings' => 'Zaznacz nagłówki',
                'content_scaling' => 'Skalowanie treści',
                'font_size' => 'Czcionka',
                'line_height' => 'Wysokość linii',
                'letter_spacing' => 'Odstęp liter',
                'docs_link_label' => 'Deklaracja dostępności',
                'made_by_label' => 'made by:',
            ),
            'en' => array(
                'trigger_aria' => 'Open accessibility menu',
                'panel_aria' => 'Accessibility options',
                'panel_title' => 'Accessibility',
                'reset_aria' => 'Reset',
                'close_aria' => 'Close accessibility menu',
                'invert_colors' => 'Invert colors',
                'monochrome' => 'Monochrome',
                'dark_contrast' => 'Dark contrast',
                'light_contrast' => 'Light contrast',
                'low_saturation' => 'Low saturation',
                'high_saturation' => 'High saturation',
                'highlight_links' => 'Highlight links',
                'highlight_headings' => 'Highlight headings',
                'content_scaling' => 'Content scaling',
                'font_size' => 'Font size',
                'line_height' => 'Line height',
                'letter_spacing' => 'Letter spacing',
                'docs_link_label' => 'Accessibility declaration',
                'made_by_label' => 'made by:',
            ),
            'de' => array(
                'trigger_aria' => 'Barrierefreiheitsmenü öffnen',
                'panel_aria' => 'Optionen zur Barrierefreiheit',
                'panel_title' => 'Barrierefreiheit',
                'reset_aria' => 'Zurücksetzen',
                'close_aria' => 'Barrierefreiheitsmenü schließen',
                'invert_colors' => 'Farben umkehren',
                'monochrome' => 'Monochrom',
                'dark_contrast' => 'Dunkler Kontrast',
                'light_contrast' => 'Heller Kontrast',
                'low_saturation' => 'Geringe Sättigung',
                'high_saturation' => 'Hohe Sättigung',
                'highlight_links' => 'Links hervorheben',
                'highlight_headings' => 'Überschriften hervorheben',
                'content_scaling' => 'Inhalt skalieren',
                'font_size' => 'Schriftgröße',
                'line_height' => 'Zeilenhöhe',
                'letter_spacing' => 'Buchstabenabstand',
                'docs_link_label' => 'Erklärung zur Barrierefreiheit',
                'made_by_label' => 'made by:',
            ),
            'es' => array(
                'trigger_aria' => 'Abrir menú de accesibilidad',
                'panel_aria' => 'Opciones de accesibilidad',
                'panel_title' => 'Accesibilidad',
                'reset_aria' => 'Restablecer',
                'close_aria' => 'Cerrar menú de accesibilidad',
                'invert_colors' => 'Invertir colores',
                'monochrome' => 'Monocromo',
                'dark_contrast' => 'Contraste oscuro',
                'light_contrast' => 'Contraste claro',
                'low_saturation' => 'Baja saturación',
                'high_saturation' => 'Alta saturación',
                'highlight_links' => 'Resaltar enlaces',
                'highlight_headings' => 'Resaltar encabezados',
                'content_scaling' => 'Escala del contenido',
                'font_size' => 'Tamaño de fuente',
                'line_height' => 'Altura de línea',
                'letter_spacing' => 'Espaciado de letras',
                'docs_link_label' => 'Declaración de accesibilidad',
                'made_by_label' => 'made by:',
            ),
            'fr' => array(
                'trigger_aria' => 'Ouvrir le menu d’accessibilité',
                'panel_aria' => 'Options d’accessibilité',
                'panel_title' => 'Accessibilité',
                'reset_aria' => 'Réinitialiser',
                'close_aria' => 'Fermer le menu d’accessibilité',
                'invert_colors' => 'Inverser les couleurs',
                'monochrome' => 'Monochrome',
                'dark_contrast' => 'Contraste sombre',
                'light_contrast' => 'Contraste clair',
                'low_saturation' => 'Faible saturation',
                'high_saturation' => 'Forte saturation',
                'highlight_links' => 'Surligner les liens',
                'highlight_headings' => 'Surligner les titres',
                'content_scaling' => 'Mise à l’échelle du contenu',
                'font_size' => 'Taille du texte',
                'line_height' => 'Hauteur de ligne',
                'letter_spacing' => 'Espacement des lettres',
                'docs_link_label' => 'Déclaration d’accessibilité',
                'made_by_label' => 'made by:',
            ),
            'it' => array(
                'trigger_aria' => 'Apri menu accessibilità',
                'panel_aria' => 'Opzioni di accessibilità',
                'panel_title' => 'Accessibilità',
                'reset_aria' => 'Reimposta',
                'close_aria' => 'Chiudi menu accessibilità',
                'invert_colors' => 'Inverti colori',
                'monochrome' => 'Monocromatico',
                'dark_contrast' => 'Contrasto scuro',
                'light_contrast' => 'Contrasto chiaro',
                'low_saturation' => 'Bassa saturazione',
                'high_saturation' => 'Alta saturazione',
                'highlight_links' => 'Evidenzia link',
                'highlight_headings' => 'Evidenzia titoli',
                'content_scaling' => 'Scala contenuto',
                'font_size' => 'Dimensione testo',
                'line_height' => 'Interlinea',
                'letter_spacing' => 'Spaziatura lettere',
                'docs_link_label' => 'Dichiarazione di accessibilità',
                'made_by_label' => 'made by:',
            ),
            'nl' => array(
                'trigger_aria' => 'Toegankelijkheidsmenu openen',
                'panel_aria' => 'Toegankelijkheidsopties',
                'panel_title' => 'Toegankelijkheid',
                'reset_aria' => 'Resetten',
                'close_aria' => 'Toegankelijkheidsmenu sluiten',
                'invert_colors' => 'Kleuren omkeren',
                'monochrome' => 'Monochroom',
                'dark_contrast' => 'Donker contrast',
                'light_contrast' => 'Licht contrast',
                'low_saturation' => 'Lage verzadiging',
                'high_saturation' => 'Hoge verzadiging',
                'highlight_links' => 'Links markeren',
                'highlight_headings' => 'Koppen markeren',
                'content_scaling' => 'Inhoud schalen',
                'font_size' => 'Tekstgrootte',
                'line_height' => 'Regelhoogte',
                'letter_spacing' => 'Letterafstand',
                'docs_link_label' => 'Toegankelijkheidsverklaring',
                'made_by_label' => 'made by:',
            ),
        );
    }

    public static function language_names()
    {
        return array(
            'pl' => 'Polish',
            'en' => 'English',
            'de' => 'German',
            'es' => 'Spanish',
            'fr' => 'French',
            'it' => 'Italian',
            'nl' => 'Dutch',
        );
    }

    public static function normalize_language_code($code)
    {
        if (is_array($code)) {
            return '';
        }

        $code = strtolower(trim((string) $code));
        $code = str_replace('_', '-', $code);
        $code = preg_replace('/[^a-z0-9-]/', '', $code);

        if (! preg_match('/^[a-z]{2,3}(-[a-z0-9]{2,8})?$/', $code)) {
            return '';
        }

        return $code;
    }

    public static function get_default_language()
    {
        $default = self::normalize_language_code(get_option('isifu_acc_default_lang', 'pl'));
        return $default ? $default : 'pl';
    }

    public static function get_enabled_languages()
    {
        $languages = get_option('isifu_acc_enabled_langs', array('pl', 'en'));

        if (is_string($languages)) {
            $languages = preg_split('/[\s,]+/', $languages);
        }

        if (! is_array($languages)) {
            $languages = array();
        }

        $normalized = array();
        foreach ($languages as $language) {
            $code = self::normalize_language_code($language);
            if ($code && ! in_array($code, $normalized, true)) {
                $normalized[] = $code;
            }
        }

        $default = self::get_default_language();
        if (! in_array($default, $normalized, true)) {
            array_unshift($normalized, $default);
        }

        return $normalized ? $normalized : array('pl');
    }

    public static function get_translations()
    {
        $translations = get_option('isifu_acc_translations', array());

        if (! is_array($translations) || empty($translations)) {
            $translations = array(
                'pl' => self::presets()['pl'],
                'en' => self::presets()['en'],
            );
        }

        return $translations;
    }

    public static function get_current_language()
    {
        $default = self::get_default_language();

        if (! isset($_GET['lang'])) {
            return $default;
        }

        $requested = self::normalize_language_code(wp_unslash($_GET['lang']));
        $enabled = self::get_enabled_languages();

        if ($requested && in_array($requested, $enabled, true)) {
            return $requested;
        }

        $primary = explode('-', $requested)[0];
        if ($primary && in_array($primary, $enabled, true)) {
            return $primary;
        }

        return $default;
    }

    public static function get_translation($language = '')
    {
        $language = self::normalize_language_code($language);
        $default = self::get_default_language();
        $translations = self::get_translations();
        $presets = self::presets();

        $base = isset($presets['pl']) ? $presets['pl'] : array();
        $default_translation = isset($translations[$default]) ? self::remove_empty_values($translations[$default]) : array();
        $language_translation = isset($translations[$language]) ? self::remove_empty_values($translations[$language]) : array();

        return array_merge($base, $default_translation, $language_translation);
    }

    private static function remove_empty_values($values)
    {
        if (! is_array($values)) {
            return array();
        }

        return array_filter($values, function ($value) {
            return '' !== trim((string) $value);
        });
    }

    public static function language_label($code)
    {
        $names = self::language_names();
        return isset($names[$code]) ? $names[$code] . ' (' . $code . ')' : strtoupper($code);
    }
}
