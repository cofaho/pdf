<?php

namespace pdf\Document\Page;

use pdf\Graphic\Operator\Path\PathInterface;
use pdf\Graphic\Operator\Text\TextInterface;

interface ContentStreamInterface extends PageDescriptionInterface, PathInterface, TextInterface
{

}
