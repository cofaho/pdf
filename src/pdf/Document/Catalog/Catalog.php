<?php

namespace pdf\Document\Catalog;


use lib\DataStructure\NumberTree;
use lib\Document\NameDictionary;
use pdf\Document\Catalog\StructureTree\StructureTreeRoot;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\StringObject;

/**
 * @property-read NameObject Type
 * @property NameObject Version
 * @property DictionaryObject Extensions
 * @property ObjectReference Pages
 * @property NumberTree PageLabels
 * @property NameDictionary Names
 * @property ObjectReference Dests
 * @property ViewerPreferencesDictionary ViewerPreferences
 * @property NameObject PageLayout
 * @property NameObject PageMode
 * @property ObjectReference Outlines
 * @property ObjectReference Threads
 * @property ArrayObject|DictionaryObject OpenAction
 * @property DictionaryObject AA additional actions
 * @property DictionaryObject URI
 * @property InteractiveFormDictionary AcroForm
 * @property ObjectReference Metadata
 * @property StructureTreeRoot StructTreeRoot
 * @property MarkInformationDictionary MarkInfo
 * @property StringObject Lang
 * @property DictionaryObject SpiderInfo
 * @property ArrayObject OutputIntents
 * @property DictionaryObject PieceInfo
 * @property OCPropertiesDictionary OCProperties
 * @property PermissionsDictionary Perms
 * @property LegalAttestationDictionary Legal
 * @property ArrayObject Requirements
 * @property CollectionDictionary Collection
 * @property bool NeedsRendering
 */
class Catalog extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Catalog';
    }

    /**
     * @param string $name
     * @param string $baseVersion
     * @param integer $level
     * @throws \Exception
     */
    public function addDeveloperExtension($name, $baseVersion, $level)
    {
        if ($this->Extensions === null) {
            $this->Extensions = new DictionaryObject();
        }
        $name = NameObject::escape($name);
        $this->Extensions->$name = new DeveloperExtensionsDictionary([
            'BaseVersion' => new NameObject($baseVersion),
            'ExtensionLevel' => $level
        ]);
    }

}
