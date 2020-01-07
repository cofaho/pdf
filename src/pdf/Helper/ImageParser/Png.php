<?php
// This is a generated file! Please edit source .ksy file and use kaitai-struct-compiler to rebuild

namespace pdf\Helper\ImageParser;

class Png extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \Kaitai\Struct\Struct $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_magic = $this->_io->ensureFixedContents("\x89\x50\x4E\x47\x0D\x0A\x1A\x0A");
        $this->_m_ihdrLen = $this->_io->ensureFixedContents("\x00\x00\x00\x0D");
        $this->_m_ihdrType = $this->_io->ensureFixedContents("\x49\x48\x44\x52");
        $this->_m_ihdr = new \pdf\Helper\ImageParser\Png\IhdrChunk($this->_io, $this, $this->_root);
        $this->_m_ihdrCrc = $this->_io->readBytes(4);
        $this->_m_chunks = [];
        $i = 0;
        do {
            $_ = new \pdf\Helper\ImageParser\Png\Chunk($this->_io, $this, $this->_root);
            $this->_m_chunks[] = $_;
            $i++;
        } while (!( (($_->type() == "IEND") || ($this->_io()->isEof())) ));
    }
    protected $_m_magic;
    protected $_m_ihdrLen;
    protected $_m_ihdrType;
    protected $_m_ihdr;
    protected $_m_ihdrCrc;
    protected $_m_chunks;
    public function magic() { return $this->_m_magic; }
    public function ihdrLen() { return $this->_m_ihdrLen; }
    public function ihdrType() { return $this->_m_ihdrType; }
    public function ihdr() { return $this->_m_ihdr; }
    public function ihdrCrc() { return $this->_m_ihdrCrc; }
    public function chunks() { return $this->_m_chunks; }
}

namespace pdf\Helper\ImageParser\Png;

class Rgb extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\PlteChunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_r = $this->_io->readU1();
        $this->_m_g = $this->_io->readU1();
        $this->_m_b = $this->_io->readU1();
    }
    protected $_m_r;
    protected $_m_g;
    protected $_m_b;
    public function r() { return $this->_m_r; }
    public function g() { return $this->_m_g; }
    public function b() { return $this->_m_b; }
}

namespace pdf\Helper\ImageParser\Png;

class Chunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_len = $this->_io->readU4be();
        $this->_m_type = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(4), "UTF-8");
        switch ($this->type()) {
            case "iTXt":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\InternationalTextChunk($io, $this, $this->_root);
                break;
            case "gAMA":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\GamaChunk($io, $this, $this->_root);
                break;
            case "tIME":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\TimeChunk($io, $this, $this->_root);
                break;
            case "PLTE":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\PlteChunk($io, $this, $this->_root);
                break;
            case "bKGD":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\BkgdChunk($io, $this, $this->_root);
                break;
            case "pHYs":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\PhysChunk($io, $this, $this->_root);
                break;
            case "tEXt":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\TextChunk($io, $this, $this->_root);
                break;
            case "cHRM":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\ChrmChunk($io, $this, $this->_root);
                break;
            case "iCCP":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\IccpChunk($io, $this, $this->_root);
                break;
            case "sRGB":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\SrgbChunk($io, $this, $this->_root);
                break;
            case "zTXt":
                $this->_m__raw_body = $this->_io->readBytes($this->len());
                $io = new \Kaitai\Struct\Stream($this->_m__raw_body);
                $this->_m_body = new \pdf\Helper\ImageParser\Png\CompressedTextChunk($io, $this, $this->_root);
                break;
            default:
                $this->_m_body = $this->_io->readBytes($this->len());
                break;
        }
        $this->_m_crc = $this->_io->readBytes(4);
    }
    protected $_m_len;
    protected $_m_type;
    protected $_m_body;
    protected $_m_crc;
    protected $_m__raw_body;
    public function len() { return $this->_m_len; }
    public function type() { return $this->_m_type; }
    public function body() { return $this->_m_body; }
    public function crc() { return $this->_m_crc; }
    public function _raw_body() { return $this->_m__raw_body; }
}

namespace pdf\Helper\ImageParser\Png;

class BkgdIndexed extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\BkgdChunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_paletteIndex = $this->_io->readU1();
    }
    protected $_m_paletteIndex;
    public function paletteIndex() { return $this->_m_paletteIndex; }
}

namespace pdf\Helper\ImageParser\Png;

class Point extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\ChrmChunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_xInt = $this->_io->readU4be();
        $this->_m_yInt = $this->_io->readU4be();
    }
    protected $_m_x;
    public function x() {
        if ($this->_m_x !== null)
            return $this->_m_x;
        $this->_m_x = ($this->xInt() / 100000.0);
        return $this->_m_x;
    }
    protected $_m_y;
    public function y() {
        if ($this->_m_y !== null)
            return $this->_m_y;
        $this->_m_y = ($this->yInt() / 100000.0);
        return $this->_m_y;
    }
    protected $_m_xInt;
    protected $_m_yInt;
    public function xInt() { return $this->_m_xInt; }
    public function yInt() { return $this->_m_yInt; }
}

namespace pdf\Helper\ImageParser\Png;

class BkgdGreyscale extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\BkgdChunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_value = $this->_io->readU2be();
    }
    protected $_m_value;
    public function value() { return $this->_m_value; }
}

namespace pdf\Helper\ImageParser\Png;

class ChrmChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_whitePoint = new \pdf\Helper\ImageParser\Png\Point($this->_io, $this, $this->_root);
        $this->_m_red = new \pdf\Helper\ImageParser\Png\Point($this->_io, $this, $this->_root);
        $this->_m_green = new \pdf\Helper\ImageParser\Png\Point($this->_io, $this, $this->_root);
        $this->_m_blue = new \pdf\Helper\ImageParser\Png\Point($this->_io, $this, $this->_root);
    }
    protected $_m_whitePoint;
    protected $_m_red;
    protected $_m_green;
    protected $_m_blue;
    public function whitePoint() { return $this->_m_whitePoint; }
    public function red() { return $this->_m_red; }
    public function green() { return $this->_m_green; }
    public function blue() { return $this->_m_blue; }
}

namespace pdf\Helper\ImageParser\Png;

class IhdrChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_width = $this->_io->readU4be();
        $this->_m_height = $this->_io->readU4be();
        $this->_m_bitDepth = $this->_io->readU1();
        $this->_m_colorType = $this->_io->readU1();
        $this->_m_compressionMethod = $this->_io->readU1();
        $this->_m_filterMethod = $this->_io->readU1();
        $this->_m_interlaceMethod = $this->_io->readU1();
    }
    protected $_m_width;
    protected $_m_height;
    protected $_m_bitDepth;
    protected $_m_colorType;
    protected $_m_compressionMethod;
    protected $_m_filterMethod;
    protected $_m_interlaceMethod;
    public function width() { return $this->_m_width; }
    public function height() { return $this->_m_height; }
    public function bitDepth() { return $this->_m_bitDepth; }
    public function colorType() { return $this->_m_colorType; }
    public function compressionMethod() { return $this->_m_compressionMethod; }
    public function filterMethod() { return $this->_m_filterMethod; }
    public function interlaceMethod() { return $this->_m_interlaceMethod; }
}

namespace pdf\Helper\ImageParser\Png;

class PlteChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_entries = [];
        $i = 0;
        while (!$this->_io->isEof()) {
            $this->_m_entries[] = new \pdf\Helper\ImageParser\Png\Rgb($this->_io, $this, $this->_root);
            $i++;
        }
    }
    protected $_m_entries;
    public function entries() { return $this->_m_entries; }
}

namespace pdf\Helper\ImageParser\Png;

class SrgbChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_renderIntent = $this->_io->readU1();
    }
    protected $_m_renderIntent;
    public function renderIntent() { return $this->_m_renderIntent; }
}

namespace pdf\Helper\ImageParser\Png\SrgbChunk;

class Intent {
    const PERCEPTUAL = 0;
    const RELATIVE_COLORIMETRIC = 1;
    const SATURATION = 2;
    const ABSOLUTE_COLORIMETRIC = 3;
}

namespace pdf\Helper\ImageParser\Png;

class CompressedTextChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_keyword = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesTerm(0, false, true, true), "UTF-8");
        $this->_m_compressionMethod = $this->_io->readU1();
        $this->_m__raw_textDatastream = $this->_io->readBytesFull();
        $this->_m_textDatastream = \Kaitai\Struct\Stream::processZlib($this->_m__raw_textDatastream);
    }
    protected $_m_keyword;
    protected $_m_compressionMethod;
    protected $_m_textDatastream;
    protected $_m__raw_textDatastream;
    public function keyword() { return $this->_m_keyword; }
    public function compressionMethod() { return $this->_m_compressionMethod; }
    public function textDatastream() { return $this->_m_textDatastream; }
    public function _raw_textDatastream() { return $this->_m__raw_textDatastream; }
}

namespace pdf\Helper\ImageParser\Png;

class BkgdTruecolor extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\BkgdChunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_red = $this->_io->readU2be();
        $this->_m_green = $this->_io->readU2be();
        $this->_m_blue = $this->_io->readU2be();
    }
    protected $_m_red;
    protected $_m_green;
    protected $_m_blue;
    public function red() { return $this->_m_red; }
    public function green() { return $this->_m_green; }
    public function blue() { return $this->_m_blue; }
}

namespace pdf\Helper\ImageParser\Png;

class GamaChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_gammaInt = $this->_io->readU4be();
    }
    protected $_m_gammaRatio;
    public function gammaRatio() {
        if ($this->_m_gammaRatio !== null)
            return $this->_m_gammaRatio;
        $this->_m_gammaRatio = (100000.0 / $this->gammaInt());
        return $this->_m_gammaRatio;
    }
    protected $_m_gammaInt;
    public function gammaInt() { return $this->_m_gammaInt; }
}

namespace pdf\Helper\ImageParser\Png;

class BkgdChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        switch ($this->_root()->ihdr()->colorType()) {
            case \pdf\Helper\ImageParser\Png\ColorType::GREYSCALE_ALPHA:
                $this->_m_bkgd = new \pdf\Helper\ImageParser\Png\BkgdGreyscale($this->_io, $this, $this->_root);
                break;
            case \pdf\Helper\ImageParser\Png\ColorType::INDEXED:
                $this->_m_bkgd = new \pdf\Helper\ImageParser\Png\BkgdIndexed($this->_io, $this, $this->_root);
                break;
            case \pdf\Helper\ImageParser\Png\ColorType::GREYSCALE:
                $this->_m_bkgd = new \pdf\Helper\ImageParser\Png\BkgdGreyscale($this->_io, $this, $this->_root);
                break;
            case \pdf\Helper\ImageParser\Png\ColorType::TRUECOLOR_ALPHA:
                $this->_m_bkgd = new \pdf\Helper\ImageParser\Png\BkgdTruecolor($this->_io, $this, $this->_root);
                break;
            case \pdf\Helper\ImageParser\Png\ColorType::TRUECOLOR:
                $this->_m_bkgd = new \pdf\Helper\ImageParser\Png\BkgdTruecolor($this->_io, $this, $this->_root);
                break;
        }
    }
    protected $_m_bkgd;
    public function bkgd() { return $this->_m_bkgd; }
}

namespace pdf\Helper\ImageParser\Png;

class PhysChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_pixelsPerUnitX = $this->_io->readU4be();
        $this->_m_pixelsPerUnitY = $this->_io->readU4be();
        $this->_m_unit = $this->_io->readU1();
    }
    protected $_m_pixelsPerUnitX;
    protected $_m_pixelsPerUnitY;
    protected $_m_unit;
    public function pixelsPerUnitX() { return $this->_m_pixelsPerUnitX; }
    public function pixelsPerUnitY() { return $this->_m_pixelsPerUnitY; }
    public function unit() { return $this->_m_unit; }
}

namespace pdf\Helper\ImageParser\Png;

class IccpChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_header = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesTerm(0, false, true, true), "ASCII");
        $this->_m_compressionMethod = $this->_io->readU1();
        $this->_m_icc = $this->_io->readBytesFull();
    }
    protected $_m_header;
    protected $_m_compressionMethod;
    protected $_m_icc;
    public function header() { return $this->_m_header; }
    public function compressionMethod() { return $this->_m_compressionMethod; }
    public function icc() { return $this->_m_icc; }
}

namespace pdf\Helper\ImageParser\Png;

class InternationalTextChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_keyword = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesTerm(0, false, true, true), "UTF-8");
        $this->_m_compressionFlag = $this->_io->readU1();
        $this->_m_compressionMethod = $this->_io->readU1();
        $this->_m_languageTag = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesTerm(0, false, true, true), "ASCII");
        $this->_m_translatedKeyword = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesTerm(0, false, true, true), "UTF-8");
        $this->_m_text = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesFull(), "UTF-8");
    }
    protected $_m_keyword;
    protected $_m_compressionFlag;
    protected $_m_compressionMethod;
    protected $_m_languageTag;
    protected $_m_translatedKeyword;
    protected $_m_text;
    public function keyword() { return $this->_m_keyword; }
    public function compressionFlag() { return $this->_m_compressionFlag; }
    public function compressionMethod() { return $this->_m_compressionMethod; }
    public function languageTag() { return $this->_m_languageTag; }
    public function translatedKeyword() { return $this->_m_translatedKeyword; }
    public function text() { return $this->_m_text; }
}

namespace pdf\Helper\ImageParser\Png;

class TextChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_keyword = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesTerm(0, false, true, true), "iso8859-1");
        $this->_m_text = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytesFull(), "iso8859-1");
    }
    protected $_m_keyword;
    protected $_m_text;
    public function keyword() { return $this->_m_keyword; }
    public function text() { return $this->_m_text; }
}

namespace pdf\Helper\ImageParser\Png;

class TimeChunk extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \pdf\Helper\ImageParser\Png\Chunk $_parent = null, \pdf\Helper\ImageParser\Png $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_year = $this->_io->readU2be();
        $this->_m_month = $this->_io->readU1();
        $this->_m_day = $this->_io->readU1();
        $this->_m_hour = $this->_io->readU1();
        $this->_m_minute = $this->_io->readU1();
        $this->_m_second = $this->_io->readU1();
    }
    protected $_m_year;
    protected $_m_month;
    protected $_m_day;
    protected $_m_hour;
    protected $_m_minute;
    protected $_m_second;
    public function year() { return $this->_m_year; }
    public function month() { return $this->_m_month; }
    public function day() { return $this->_m_day; }
    public function hour() { return $this->_m_hour; }
    public function minute() { return $this->_m_minute; }
    public function second() { return $this->_m_second; }
}

namespace pdf\Helper\ImageParser\Png;

class ColorType {
    const GREYSCALE = 0;
    const TRUECOLOR = 2;
    const INDEXED = 3;
    const GREYSCALE_ALPHA = 4;
    const TRUECOLOR_ALPHA = 6;
}

namespace pdf\Helper\ImageParser\Png;

class PhysUnit {
    const UNKNOWN = 0;
    const METER = 1;
}
