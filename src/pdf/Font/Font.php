<?php

namespace pdf\Font;


use Exception;

abstract class Font
{
    // Standard 14 Type1 Fonts

    const FONT_COURIER = 'Courier';

    const FONT_COURIER_BOLD = 'Courier-Bold';

    const FONT_COURIER_OBLIQUE = 'Courier-Oblique';
    const FONT_COURIER_ITALIC = 'Courier-Oblique';

    const FONT_COURIER_BOLD_OBLIQUE = 'Courier-BoldOblique';
    const FONT_COURIER_BOLD_ITALIC = 'Courier-BoldOblique';


    const FONT_HELVETICA = 'Helvetica';

    const FONT_HELVETICA_BOLD = 'Helvetica-Bold';

    const FONT_HELVETICA_OBLIQUE = 'Helvetica-Oblique';
    const FONT_HELVETICA_ITALIC = 'Helvetica-Oblique';

    const FONT_HELVETICA_BOLD_OBLIQUE = 'Helvetica-BoldOblique';
    const FONT_HELVETICA_BOLD_ITALIC = 'Helvetica-BoldOblique';


    const FONT_SYMBOL = 'Symbol';


    const FONT_TIMES_ROMAN = 'Times-Roman';
    const FONT_TIMES = 'Times-Roman';

    const FONT_TIMES_BOLD = 'Times-Bold';

    const FONT_TIMES_ITALIC = 'Times-Italic';

    const FONT_TIMES_BOLD_ITALIC = 'Times-BoldItalic';


    const FONT_ZAPFDINGBATS = 'ZapfDingbats';


    protected static $definedFonts = [
        self::FONT_COURIER => 1,
        self::FONT_COURIER_BOLD => 1,
        self::FONT_COURIER_ITALIC => 1,
        self::FONT_COURIER_BOLD_ITALIC => 1,
        self::FONT_HELVETICA => 1,
        self::FONT_HELVETICA_BOLD => 1,
        self::FONT_HELVETICA_ITALIC => 1,
        self::FONT_HELVETICA_BOLD_ITALIC => 1,
        self::FONT_SYMBOL => 1,
        self::FONT_TIMES_ROMAN => 1,
        self::FONT_TIMES_BOLD => 1,
        self::FONT_TIMES_ITALIC => 1,
        self::FONT_TIMES_BOLD_ITALIC => 1,
        self::FONT_ZAPFDINGBATS => 1
    ];

    protected static $fonts = [];

    /**
     * @param string $fontName
     * @return AbstractFont
     * @throws Exception
     */
    public static function getFont($fontName)
    {
        if (isset(self::$fonts[$fontName])) {
            return self::$fonts[$fontName];
        }

        if (!isset(self::$definedFonts[$fontName])) {
            throw new Exception("Undefined font `{$fontName}`");
        }

        $font = new Type1Font([
            'BaseFont' => '/' . $fontName
        ]);

        self::$fonts[$fontName] = $font;

        return $font;
    }

    /**
     * @param string $fontName
     * @param AbstractFont|string $font
     */
    public static function addFont($fontName, $font)
    {
        if (!($font instanceof AbstractFont)) {
            //TODO: implement
        }
        self::$fonts[$fontName] = $font;
    }
}
