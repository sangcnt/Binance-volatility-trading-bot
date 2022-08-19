<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BN Listening...</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <form class="pt-3">
                <div class="mb-3">
                    <textarea id="log-board" rows="10" class="form-control" id="validationTextarea" readonly></textarea>
                </div>
                <div class="mb-3">
                    <textarea id="log-trades" rows="5" class="form-control" id="validationTextarea" readonly></textarea>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            boardLine = 0;
            tradesLine = 0;
            logBoard = $('#log-board');
            logTrades = $('#log-trades');
            function getLogs() {
                $.ajax({ 
                    type: 'GET', 
                    url: 'get-tail-logs.php', 
                    data: { 
                        board_line: boardLine,
                        trades_line: tradesLine,
                    }, 
                    dataType: 'json',
                    success: function (data) {
                        if (data.board_lines.length > 0) {
                            boardLine = data.board_line_count + 1;
                            $.each(data.board_lines, function(index, line) {
                                logBoard.val(logBoard.val() + line);
                                logBoard.scrollTop(logBoard[0].scrollHeight - logBoard.height());
                            });
                        }

                        if (data.trades_lines.length > 0) {
                            tradesLine = data.trades_line_count + 1;
                            $.each(data.trades_lines, function(index, line) {
                                logTrades.val(logTrades.val() + line);
                                logTrades.scrollTop(logTrades[0].scrollHeight - logTrades.height());
                            });
                        }

                        setTimeout(getLogs, 2000);
                    }
                });
            }

            getLogs();
        </script>
    </body>

</html>