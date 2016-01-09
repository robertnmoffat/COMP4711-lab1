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

                $this->display();
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

            //Function for printing the board to the user
            function display() {
                echo "<table cols=\"3\" style=\"font-size:large; font-weight:bold\">";
                echo "<tr>"; //open first row
                for ($pos = 0; $pos < 9; $pos++) {
                    echo $this->show_cell($pos);
                    if ($pos % 3 == 2)
                        echo "</tr><tr>"; //start a new row for the next square
                }
                echo "</tr>"; //close the last row
                echo "</table>";
            }
            
            //function to return a given cell from the board
            function show_cell($which){
                $token = $this->position[$which];
                
                if($token<>'-') return "<td>".$token."</td>";
                
                $this->newposition = $this->position;
                $this->newposition[$which] = 'o';
                $move = implode($this->newposition);
                $link = "/COMP4711-lab1/?board=".$move;
                return "<td><a href=".$link.">-</a></td>";
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
                echo "o wins!";
            } else {
                echo "No winner.";
            }
        }
        ?>
    </body>
</html>