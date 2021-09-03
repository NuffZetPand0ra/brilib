<?php
require_once __DIR__.'/../vendor/autoload.php';

use nuffy\cards\DeckFactory;
use nuffy\BriLib\Bridge\{Board, BoardCollection, BoardFactory};
use nuffy\BriLib\Formats\BriHelper;

$boards = BoardFactory::generateRandomBoardCollection(32);
BriHelper::saveBoardsToFile($boards, 'outputfile.bri');
