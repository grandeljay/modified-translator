<?php

/**
 * Translations
 *
 * @version 0.2.0
 * @author  Jay Trees <translations@grandels.email>
 * @link    https://github.com/grandeljay/modified-translator
 */

namespace Grandeljay\Translator;

class Translations
{
    private array $translations = [];
    private string $moduleName  = '';
    private string $language;

    public function __construct(private string $languageFilepath)
    {
        $this->setLanguage();
        $this->setModuleName();
        $this->setDefaultTranslations();
    }

    private function setLanguage(): void
    {
        $directoryRelative = \substr($this->languageFilepath, \mb_strlen(\DIR_FS_CATALOG));
        $paths             = \explode(\DIRECTORY_SEPARATOR, $directoryRelative);

        $this->language = \strtolower($paths[1]);
    }

    private function setModuleName(): void
    {
        $directoryRelative = \substr($this->languageFilepath, \mb_strlen(\DIR_FS_CATALOG));
        $paths             = \explode(\DIRECTORY_SEPARATOR, $directoryRelative);
        $moduleType        = \strtoupper($paths[3]);
        $moduleFileName    = \strtoupper(\pathinfo($paths[4], \PATHINFO_FILENAME));

        switch ($moduleType) {
            case 'CATEGORIES':
            case 'PRODUCT':
                $moduleFileNameWithoutType = \str_replace('_' . $moduleType, '', $moduleFileName);

                $this->moduleName = \sprintf('MODULE_%1$s_%2$s_%1$s', $moduleType, $moduleFileNameWithoutType);
                break;

            default:
                $this->moduleName = \sprintf('MODULE_%s_%s', $moduleType, $moduleFileName);
                break;
        }
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
        return $this->translations[$key];
    }
}
