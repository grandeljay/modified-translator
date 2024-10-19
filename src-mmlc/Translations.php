<?php

/**
 * Translations
 *
 * @version 0.3.3
 * @author  Jay Trees <translations@grandels.email>
 * @link    https://github.com/grandeljay/modified-translator
 */

namespace Grandeljay\Translator;

class Translations
{
    private array $translations = [];
    private string $language;

    /**
     * Constructor
     *
     * @param string $languageFilepath The filepath, defining the translations.
     * @param string $moduleName       The module name, as a constant.
     */
    public function __construct(private string $languageFilepath, private string $moduleName)
    {
        $this->setLanguage();
        $this->setDefaultTranslations();
    }

    private function setLanguage(): void
    {
        $directoryRelative = \substr($this->languageFilepath, \mb_strlen(\DIR_FS_CATALOG));
        $paths             = \preg_split('/\\\|\//', $directoryRelative);

        $this->language = \strtolower($paths[1]);
    }

    private function setDefaultTranslations(): void
    {
        switch ($this->language) {
            case 'english':
                $this->add('STATUS_TITLE', 'Status');
                $this->add('STATUS_DESC', 'Select Yes to activate the module and No to deactivate it.');
                break;

            case 'german':
                $this->add('STATUS_TITLE', 'Status');
                $this->add('STATUS_DESC', 'Wählen Sie Ja um das Modul zu aktivieren und Nein um es zu deaktivieren.');
                break;

            case 'french':
                $this->add('STATUS_TITLE', 'Statut');
                $this->add('STATUS_DESC', 'Sélectionnez Oui pour activer le module et Non pour le désactiver.');
                break;

            case 'italian':
                $this->add('STATUS_TITLE', 'Stato');
                $this->add('STATUS_DESC', 'Selezioni Sì per attivare il modulo e No per disattivarlo.');
                break;

            case 'spanish':
                $this->add('STATUS_TITLE', 'Estado');
                $this->add('STATUS_DESC', 'Seleccione Sí para activar el módulo y No para desactivarlo.');
                break;
        }
    }

    public function add(string $key, string $value): void
    {
        if (isset($this->translations[$value])) {
            $this->translations[$key] = $this->translations[$value];
        } else {
            $this->translations[$key] = $value;
        }
    }

    public function define(): void
    {
        foreach ($this->translations as $key => $value) {
            define($this->moduleName . '_' . $key, $value);
        }
    }

    public function get(string $key): string
    {
        return $this->translations[$key] ?? $key;
    }
}
