<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body onload="resizeCanvas();">
<div class="Toolbar">
        - Цвет -<hr>
        <img id="redPen" src="images/red.png" height="50" width="50" alt="Красная кисть" title="Красная кисть" onclick="changeColor('rgb(212,21,29)', this)">
        <img id="greenPen" src="images/green.png" height="50" width="50" alt="Зеленая кисть" title="Зеленая кисть" onclick="changeColor('rgb(131,190,61)', this)"> 
        <img id="bluePen" src="images/blue.png" height="50" width="50" alt="Синяя кисть" title="Синяя кисть" onclick="changeColor('rgb(0,86,166)', this)">
</div>
<div class="Toolbar">
        - Толщина -<hr>
        <img src="images/pen_thin.gif" alt="Тонкая кисть" title="Тонкая кисть" onclick="changeThickness(1, this)">
        <img src="images/pen_medium.gif" alt="Нормальная кисть" title="Нормальная кисть" onclick="changeThickness(5, this)"> 
        <img src="images/pen_thick.gif" alt="Толстая кисть" title="Толстая кисть" onclick="changeThickness(10, this)">
</div>
<div class="Toolbar">
        - Операции-<hr>
        <div>
            <img id="saveCanvas" src="images/save.png" height="50" width="50"alt="Сохранить рисунок" title="Сохранить рисунок" onclick="saveCanvastoDB()">
            <img id="clearCanvas" src="images/clear.png" height="50" width="50" alt="Очистить рисунок" title="Очистить рисунок" onclick="clsCanvas()"> 
        </div>
        <div>
            <input type="text" id="passSaveCanvas" placeholder="Пароль для сохранения"/>
        </div>
</div>
<div class="Container">
    <div class="CanvasContainer">
        <canvas id="drawingCanvas"></canvas>  
    </div>
    <div class="ViewContainer">
        <div class="ListPicture">
            <?php include 'views/'.$content_view; ?>
        </div> 
    </div>
</div>
</body>
</html>