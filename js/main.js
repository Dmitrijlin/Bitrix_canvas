"use strict";
var canvas;
var context;
var isDrawing=false;
var previousColorElement;
var previousThicknessElement;
var isUpdate=false;
var updateID;

window.onload = function() {
		canvas = document.getElementById("drawingCanvas");
      	context = canvas.getContext("2d");

        // Подключаем требуемые для рисования события
      	canvas.onmousedown = startDrawing;
      	canvas.onmouseup = stopDrawing;
      	canvas.onmouseout = stopDrawing;
      	canvas.onmousemove = draw;

      	/* Jquery реализация */
		$("#drawingCanvas").mousedown(function(e){
			isDrawing = true;
			startDrawing(e);
			console.info (isDrawing);
		});
		$("#drawingCanvas").mouseup(function(e){
			isDrawing = false;
			// startDrawing(e);
			console.info (isDrawing);
		});
		$("#drawingCanvas").mousemove(function(e){
			draw(e);
			// startDrawing(e);
			console.info (isDrawing);
		});
   }


function changeColor(color, imgElement)
{
    // 	Меняем текущий цвет рисования
	context.strokeStyle = color;
	
	// Меняем стиль элемента <img>, по которому щелкнули
	imgElement.className = "Selected";
	
	// Возвращаем ранее выбранный элемент <img> в нормальное состояние
	if (previousColorElement != null)
	   previousColorElement.className = "";
	   
	previousColorElement = imgElement;
}

// Отслеживаем элемент <img> для толщины линии, по которому ранее щелкнули

function changeThickness (thickness, imgElement)
{
    // Изменяем текущую толщину линии
	context.lineWidth = thickness;
	
	// Меняем стиль элемента <img>, по которому щелкнули
	imgElement.className = "Selected";
	
	// Возвращаем ранее выбранный элемент <img> в нормальное состояние
	if (previousThicknessElement != null)
	   previousThicknessElement.className = "";
	   
	previousThicknessElement = imgElement;
}

function startDrawing(e) {
	// Начинаем рисовать
	isDrawing = true;
	
	// Создаем новый путь (с текущим цветом и толщиной линии) 
	context.beginPath();
	
	// Нажатием левой кнопки мыши помещаем "кисть" на холст
	context.moveTo(e.pageX - canvas.offsetLeft, e.pageY - canvas.offsetTop);
}

function draw(e) {
	if (isDrawing == true)
	{
	  	// Определяем текущие координаты указателя мыши
		var x = e.pageX - canvas.offsetLeft;
		var y = e.pageY - canvas.offsetTop;
		// Рисуем линию до новой координаты
		context.lineTo(x, y);
		context.stroke();
	}
}

function stopDrawing(e) {
    isDrawing = false;	
}

function clsCanvas() {
	context.clearRect(0, 0, canvas.width, canvas.height);
	isUpdate=false;
	$('body input').val('');
}

/* Функция сохранения изображения в формат PNG
isUpdate - флаг обновления изображения в БД
*/
function saveCanvastoDB() {
    // Находим элемент <img>
    var txtPass=$("#passSaveCanvas").val();
    if (txtPass.length<=0) {
    	$("#passSaveCanvas").addClass("err").focus(); 
    	return false;
    } else {
    	$("#passSaveCanvas").removeClass("err")	
    }
	var canvasData = null;//canvas.toDataURL("image/png");
	var ajax = new XMLHttpRequest();
	if (isUpdate==false) {
		ajax.open("POST",'canvas',false);
	alert ("Картинка успешно сохранена");		
	} else {
		ajax.open("POST",'canvas/update/'+updateID,false);
	alert ("Картинка № "+updateID+" успешно обновлена");
	}
	ajax.setRequestHeader('Content-Type', 'application/upload');
	ajax.send(canvasData+'&pass='+txtPass ); //

}

function loadCanvasfromDB(elem) {
	var ID=elem.id;
	var txtPass=$(".ListPicture span input[from='"+ID+"']").val();
	if (txtPass.length<=0) {
		$(".ListPicture span input").removeClass("err")
    	$(".ListPicture span input[from='"+ID+"']").addClass("err").focus(); 
    	return false;
    } else {
    	$(".ListPicture span input[from='"+ID+"']").removeClass("err")	
    }
	isUpdate=true;
	var img = new Image();
	img.onload = function() {
	context.clearRect(0, 0, canvas.width, canvas.height);		
  	context.drawImage(this, 0, 0, canvas.width, canvas.height);
	};
	updateID=ID;
	var jqxhr = $.getJSON( "canvas/load/"+ID)
	.done(function(data) { 
		if (data.password != txtPass) {
			alert ("Пароль не верен!");
			$(".ListPicture span input[from='"+ID+"']").val('');
			return false;
		}
		$("#passSaveCanvas").val('');
		img.src=data.image;
	})
}

function resizeCanvas() {
	var CanvasContainer = $("div.CanvasContainer").width();
	canvas.width=CanvasContainer;
    canvas.height = 300;
}