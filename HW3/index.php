<!DOCTYPE html>
<html>
</html>


<body>
    <h2>Parts a, b</h2>
    <p>Making an array and outputting a table with keys (Pokemon) and values (IDs)</p>
    <?php 
        $pokemonArray = [
            "Pikachu" => 1,
            "Charizard" => 5,
            "Eevee" => 7,
            "Jigglypuff" => 3,
            "Mew" => 2,
            "Ivysaur" => 10,
            "Abra" => 4,
            "Oddish" => 9,
            "Machop" => 8,
            "Squirtle" => 6
        ];

        echo "<table>
                <tr>
                <th>Pokemon</th>
                <th>ID</th>
                </tr>";
        foreach ($pokemonArray as $key => $value) {
            echo "<tr>
                    <td>$value</td>
                    <td>$key</td>
                </tr>";
        }
        echo "</table>";
    ?>

        
    <?php 

        function printTable(array $data, $optional = null) {
            echo "<table>
            <tr>
            <th>Pokemon</th>
            <th>ID</th>
            </tr>";
        foreach ($data as $key => $value) {
        echo "<tr>
                <td>$value</td>
                <td>$key</td>
            </tr>";
        }
        echo "</table>";
        }

        for( $i = 0; $i < 6; $i++ ) {
            switch ($i) {
                case 0: // code to be executed if x = 1
                    echo "<h2>Part a, b</h2>
                    <p>Initializing the array and printing out intiial values</p>";
                    printTable( $pokemonArray );
                    break;
                case 1: // code to be executed if x = 2
                    echo "<h2>Part c</h2>";
                    break;
                case 2: // code to be executed if x = 3
                    echo "<h2>Part d</h2>
                    <p>Sorting the array by ascending values</p>";
                    asort( $pokemonArray );
                    printTable( $pokemonArray );
                    break;
                case 3: // code to be executed if x = 3
                    echo "<h2>Part e</h2>
                    <p>Unset the 4th element of the array</p>";
                    unset( $pokemonArray[3] );
                    printTable( $pokemonArray );
                    break;
                case 4: // code to be executed if x = 3
                    echo "<h2>Part f</h2>
                    <p>Sort the array in reverse</p>";
                    arsort( $pokemonArray );
                    printTable( $pokemonArray );
                    break;
                case 5: // code to be executed if x = 3
                    echo "<h2>Part g</h2>
                    <p>Sort array by keys</p>";
                    break;
            }


        
        }

    ?>

    <h2>Part c</h2>
    <p>Criteria: All pokemon with ID less than or equal to 4</p>

    <?php
        echo "<table>
                <tr>
                <th>Pokemon</th>
                <th>ID (<=4)</th>
                </tr>";
        foreach ($pokemonArray as $key => $value) {
            if($value <= 4){
            echo "<tr>
                    <td>$value</td>
                    <td>$key</td>
                </tr>";
            }
        }
        echo "</table>";
    ?>


</body>