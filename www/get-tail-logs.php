<?php
function getLineCount($file = '') {    
    $linecount = 0;
    $handle = fopen($file, "r");
    while(!feof($handle)){
        $line = fgets($handle);
        $linecount++;
    }

    fclose($handle);

    return $linecount;
}

function getLinesFrom($file = '', $from_line) {
    $lines = [];

    $linecount = 0;
    $handle = fopen($file, "r");
    while(!feof($handle)){
        $line = fgets($handle);
        $linecount++;
        if ($linecount >= $from_line && $line !== false) {
            $lines[] = $line;
        }
    }

    fclose($handle);
    return $lines;
}

$board_file_path = "../bn-log.txt";
$board_line_count = getLineCount($board_file_path) - 1;

$board_from_line = isset($_GET['board_line']) && $_GET['board_line'] > 0 ? $_GET['board_line'] : $board_line_count - 20; // Get last 10 line if $from_line is empty
$board_lines = getLinesFrom($board_file_path, $board_from_line);

$trades_file_path = "../trades.txt";
$trades_line_count = getLineCount($trades_file_path) - 1;
$trades_from_line = isset($_GET['trades_line']) && $_GET['trades_line'] > 0 ? $_GET['trades_line'] : $trades_line_count - 20; // Get last 10 line if $from_line is empty
$trades_lines = getLinesFrom($trades_file_path, $trades_from_line);

echo json_encode([
    'board_lines' => $board_lines,
    'trades_lines' => $trades_lines,
    'board_line_count' => $board_line_count,
    'trades_line_count' => $trades_line_count
]);
exit();