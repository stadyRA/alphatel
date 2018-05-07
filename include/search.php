<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db');

if (!mysqli_connect(DB_HOST, DB_USER, DB_PASS)) {
    exit('Cannot connect to server');
}
if (!mysqli_select_db(DB_NAME)) {
    exit('Cannot select database');
}

mysqli_query('SET NAMES utf8');

function search ($query) 
{ 
    $query = trim($query); 
    $query = mysqli_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else { 
            $q = "SELECT `id_doc`,`doc`,`type_doc`, `vho_doc`,`id_type_doc` 
            FROM `dokuments` WHERE `text` LIKE '%$query%'
                  OR `doc` LIKE '%$query%' OR `vho_doc` LIKE '%$query%'";

            $result = mysqli_query($q);

            if (mysqli_affected_rows() > 0) { 
                $row = mysqli_fetch_assoc($result); 
                $num = mysqli_num_rows($result);

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';

                do {
                    // Делаем запрос, получающий ссылки на статьи
                    $q1 = "SELECT `link` FROM `dokuments` WHERE `id_doc` = '$row[id_doc]'";
                    $result1 = mysql_query($q1);

                    if (mysqli_affected_rows() > 0) {
                        $row1 = mysqli_fetch_assoc($result1);
                    }

                    $text .= '<p><a> href="'.$row1['link'].'/'.$row['vho_doc'].'/'.$row['id_doc'].'" doc="'.$row['doc_link'].'">'.$row['doc'].'</a></p>
                    <p>'.$row['desc'].'</p>';

                } while ($row = mysqli_fetch_assoc($result)); 
            } else {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            }
        } 
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
} 
?>
<?php 
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>