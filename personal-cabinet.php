<? include ("proverka.php");
$stmt = $link->prepare("SELECT surname,name,patronymic,roleLevel,headman FROM users WHERE id=:id");
$parametr = ['id' =>$id];
$stmt->execute($parametr);
$data = $stmt->fetchAll();


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <? include ('global-link.php');?>
</head>

<body>
    <? include ('heder.php');?>
    <link rel="stylesheet" href="personal-cabinet.css">
    <div class="osnov">
        <div class="lk">Личный кабинет</div>
        <div class="personal-info">
            <div class="fio">
                <? echo $data[0][0]," ",$data[0][1]," ",$data[0][2];?>
            </div>
            <div class="menu-lk">
                <?if($data[0][4]!=0){
echo <<<END
<a class="menu-a-cnop-lk" href="#"><div class="menu-cnop-lk magazine">журнал</div></a>                  
END;
}?>
                <a class="menu-a-cnop-lk" href="#">
                    <div class="menu-cnop-lk settings">настройки</div>
                </a>

                <?if($data[0][3]!=0){
echo <<<END
<a class="menu-a-cnop-lk"  target=\"_blank\" href="panel/panel.php"><div class="menu-cnop-lk admin-panel">админ-панель</div></a>                   
END;
}?>
                <a class="menu-a-cnop-lk" href="delete.php">
                    <div class="menu-cnop-lk out">выйти</div>
                </a>
            </div>
        </div>
        <div class="timetable">
            <div class="timetable-name">Расписание занятий</div>
            <div class="info-timetable">
                <div class="inf-text"><span style="color:#fdbd43">*</span>семенары <br><span style="color:#27b386">*</span>лекции</div>
                <div class="timetable-cnop">
                    <input type="checkbox" class="checkbox" id="checkbox">
                    <label for="checkbox" class="checkbox-label"></label>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
