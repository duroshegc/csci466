<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oluwasegun Durosinmi z1978798</title>
</head>
<body>

    <h1>CSCI 466 Assignment 9</h1>
    <?php
        $word = $count = $listtypes = "";
        $numstart = $numstep = $numnums = 0;
        $track_list = false;
        $multp_table = false;

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $word = filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING);
            $count = filter_input(INPUT_POST, 'count', FILTER_VALIDATE_INT);
            $listtype = filter_input(INPUT_POST, 'listtype', FILTER_SANITIZE_STRING);
            $numstart = filter_input(INPUT_POST, 'numstart', FILTER_VALIDATE_INT);
            $numstep = filter_input(INPUT_POST, 'numstep', FILTER_VALIDATE_INT);
            $numnums = filter_input(INPUT_POST, 'numnums', FILTER_VALIDATE_INT);

            if(!empty($word) && $word !== false && !empty($count) && $count >= 0 && ($listtype == 'ordered' || $listtype == 'unordered'))
            {
                $track_list = true;
            }

            if($numstart !== false && $numstep !== false && $numnums !== false)
            {
                $multp_table = true;
            }
        }
 
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

        Enter a word: <input type="text" name="word" />
       <br><br>
        Items Count: <input type="text" name="count">
        <br><br>
        Choose one:
        <input type="radio" name="listtype" value="ordered">ordered

        <input type="radio" name="listtype" value="unordered">unordered
        <br><br> 
     
        <?php
            $droplist = ['numstart', 'numstep', 'numnums'];
            foreach ($droplist as $value) {
                echo $value . ': <select name="' . $value . '">';
                for ($i = 0; $i < 10; $i++) {
                    echo '<option value="' . $i . '" ' . ((${$value} == $i) ? 'selected' : '') . '>' . $i . '</option>';
                }
                echo '</select>';
                echo '<br>';
            }       
        ?>  
        <br><br>
        <input type="submit" name="submit" value="LETS'S GOOOO">
        <br><br>
    </form>
    
    <?php
            if($track_list)
            {
                if($listtype == 'ordered')
                {
                    echo '<h2>Ordered List</h2>';
                    echo '<ol>'; 
                }
                else
                {
                    echo '<h2>Unordered List</h2>';
                    echo '<ul>';
                }

                for($i = 0; $i < $count; $i++)
                {
                    echo '<li>' . htmlspecialchars($word) . '</li>';
                }

                if($listtype == 'ordered')
                {
                    echo '</ol>';
                }
                else
                {
                    echo '</ul>';
                }
            }
            else if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                echo '<p>List display parameters not received.</p>';
            }
            

           if($multp_table)
           {
            
            echo '<table border="1">';
            echo '<h2>Multiplication Table</h2>';

            for($i = 0; $i <= $numnums; $i++)
            {
                
                echo '<tr';
                for($j = 0; $j <= $numnums; $j++)
                {
                    if($i == 0 && $j ==0)
                    {
                        echo '<th></th>';
                    }
                    else if($i == 0)
                    {
                        echo '<th>' . ($numstart + $j * $numstep) . '</th>';

                    }
                    else if($j == 0)
                    {
                        echo '<th>' . ($numstart + $i * $numstep) . '</th>';
                    }
                    else
                    {
                        echo '<td>' . (($numstart + $i * $numstep) * ($numstart + $j * $numstep)) . '</td>';
                    }
                }
                echo '</tr>';
            }
            echo '</table>';
           }
           else if($_SERVER["REQUEST_METHOD"] == "POST")
           {
                echo '<p>Multiplication parameters not received.</p>';
           }
    ?>
   

</body>
</html>