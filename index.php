<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Tic Tac Toe Lab</title>
    </head>
    <body>
        <?php

        class Game {

            var $position;

            //Constructor for Game class. takes a map of squares as a parameter
            function __construct($squares) {        
                $this->position = str_split($squares);                   
                
                for ($row = 0; $row < 3; $row++) {
                    for ($col = 0; $col < 3; $col++) {
                        echo $this->position[3 * $row + $col];
                    }
                    echo "<br>";
                }
            }

            //Function to determine if the passed token is the current winner
            function winner($token) {
                $won = false;

                //Checking for a line horizontally.
                for ($row = 0; $row < 3; $row++) {
                    $result = true;
                    for ($col = 0; $col < 3; $col++) {
                        if ($this->position[3 * $row + $col] != $token)
                            $result = false;
                    }
                    if ($result == true) {
                        $won = true;
                    }
                }

                //Checking for a line vertically.
                for ($col = 0; $col < 3; $col++) {
                    $result = true;
                    for ($row = 0; $row < 3; $row++) {
                        if ($this->position[3 * $row + $col] != $token)
                            $result = false;
                    }
                    if ($result == true) {
                        $won = true;
                    }
                }

                //Checking diagonally, starting with center (if not center, no need to check rest)
                if ($this->position[4] == $token &&
                        (($this->position[0] == $token && $this->position[8] == $token) ||
                        ($this->position[2] == $token && $this->position[6] == $token))) {
                    $won = true;
                }

                return $won;
            }

        }

        if (!isset($_GET['board'])) {
            echo "No board parameter passed.";
        } else {
            $board = $_GET['board'];
            $game = new Game($board);

            if ($game->winner('x')) {
                echo "x wins!";
            } else if ($game->winner('o')) {
                echo "y wins!";
            } else {
                echo "No winner.";
            }
        }
        ?>
    </body>
</html>