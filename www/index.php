<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BN Listening...</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>

    <body>
        <div class="container vh-100 pt-2 d-flex flex-column">
            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-trades-tab" data-bs-toggle="pill" data-bs-target="#pills-trades" type="button" role="tab" aria-controls="pills-trades" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-board-tab" data-bs-toggle="pill" data-bs-target="#pills-board" type="button" role="tab" aria-controls="pills-board" aria-selected="false">Profile</button>
                </li>
            </ul>
            <div id="pills-tabContent" class="tab-content flex-fill py-2">
                <div class="tab-pane fade h-100 show active" id="pills-trades" role="tabpanel" aria-labelledby="pills-trades-tab">
                    <div id="log-trades" class="overflow-auto small h-75 border border-secondary p-2 rounded" id="validationTextarea" readonly></div>
                </div>
                <div class="tab-pane fade h-100" id="pills-board" role="tabpanel" aria-labelledby="pills-board-tab">
                    <div id="log-board" class="overflow-auto small h-75 border border-secondary p-2 rounded" id="validationTextarea" readonly></div>
                </div>
            </div>
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
                                logBoard.html(line + "<br>" + logBoard.html());
                            });
                        }

                        if (data.trades_lines.length > 0) {
                            tradesLine = data.trades_line_count + 1;
                            $.each(data.trades_lines, function(index, line) {
                                logTrades.html(line + "<br>" + logTrades.html());
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