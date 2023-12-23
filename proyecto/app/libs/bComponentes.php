<?php




// Función para pintar un checkbox con los valores que nos pasan por un array

function pintaCheck(array $valores, string $name){
    foreach($valores as $key=>$valor){
    echo '<label><input type="checkbox" name="'.$name.'[]" value='.$key.'>'.$valor.'</label>';
    };
};

function pintaRadio(array $valores, string $name){
    foreach($valores as $key=>$valor){
        echo '<input type="radio" name="'.$name.'" value="'.$valor.'">'. $valor.'<br>';

    };
};

function pintaSelect (array $valores, string $name){
    echo'<select name="'.$name.'" >';

          foreach($valores as $key => $valor){

            echo '<option value="'.$key.'" >'.$valor.'</option>';
        }
        echo'</select>';
}

// muestra una tabla con las imagenes del array
function mostrarTabla($ficheros)
{
    echo "<table>";
    for ($i = 0; $i < count($ficheros); $i += 2) {
        echo "<tr>";
        echo '<td><img src="' . $ficheros[$i] . '" style="width:200px"></td>';
        if ($i + 1 != count($ficheros))
            echo '<td><img src="' . $ficheros[$i + 1] . '" style="width:200px"></td>';
        echo "</tr>";
    }
    echo "</table>";
}



?>