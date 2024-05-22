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
            <th>ID</th>
            <th>Pokemon</th>
            </tr>";
        if  ($optional == null ) { 
        foreach ($data as $key => $value) {
        echo "<tr>
                <td>$value</td>
                <td>$key</td>
            </tr>";
        }
        echo "</table>";
        } else {
            foreach ($data as $key => $value) {
                if ($value > $optional){
                    echo "<tr>
                        <td>$value</td>
                        <td>$key</td>
                    </tr>";
                }
            }
                echo "</table>";
        }


        }

        for( $i = 0; $i < 6; $i++ ) {
            switch ($i) {
                case 0:
                    echo "<h2>Part a, b</h2>
                    <p>Initializing the array and printing out intiial values</p>";
                    printTable( $pokemonArray );
                    break;
                case 1: 
                    echo "<h2>Part c</h2>
                    <p>Print array with specific criteria (Value > 4)";
                    printTable( $pokemonArray, 4);
                    break;
                case 2: 
                    echo "<h2>Part d</h2>
                    <p>Sorting the array by ascending values</p>";
                    asort( $pokemonArray );
                    printTable( $pokemonArray );
                    break;
                case 3: 
                    echo "<h2>Part e</h2>
                    <p>Unset the 4th element of the array</p>";
                    $keys = array_keys($pokemonArray);
                    unset( $pokemonArray[$keys[3]] );
                    printTable( $pokemonArray );
                    break;
                case 4: 
                    echo "<h2>Part f</h2>
                    <p>Sort the array in reverse</p>";
                    arsort( $pokemonArray );
                    printTable( $pokemonArray );
                    break;
                case 5: 
                    echo "<h2>Part g</h2>
                    <p>Sort array by keys</p>";
                    ksort( $pokemonArray );
                    printTable( $pokemonArray );
                    break;
            }


        
        }

    ?>


</body>