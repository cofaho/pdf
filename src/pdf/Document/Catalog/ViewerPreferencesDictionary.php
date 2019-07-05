<?php

namespace pdf\Document\Catalog;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property boolean HideToolbar
 * @property boolean HideMenubar
 * @property boolean HideWindowUI
 * @property boolean FitWindow
 * @property boolean CenterWindow
 * @property boolean DisplayDocTitle
 * @property NameObject NonFullScreenPageMode
 * @property NameObject Direction
 * @property NameObject ViewArea
 * @property NameObject ViewClip
 * @property NameObject PrintArea
 * @property NameObject PrintClip
 * @property NameObject PrintScaling
 * @property NameObject Duplex
 * @property boolean PickTrayByPDFSize
 * @property ArrayObject PrintPageRange
 * @property integer NumCopies
 */
class ViewerPreferencesDictionary extends DictionaryObject
{
    // TODO: implement
}
