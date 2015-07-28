jQuery.noConflict();

 function wpavk_sl(id) { 
	return document.getElementById(id); 
} 
 
function wpavk_wr(item){
	var input=wpavk_sl('area'); 
	
	input.focus();
	if (input.setSelectionRange) {
		var srt = input.selectionStart;
		var len = input.selectionEnd;
		if (srt < len) srt++;
		input.value = input.value.substr(0,srt)+item+input.value.substr(len);
		input.setSelectionRange(srt+1,srt+1);
	}
	else{
		var range=document.selection.createRange();
		range.text=item;
	}
		input.focus();
		input.scrollTop = input.scrollHeight;	
}



function wpavk_setSelectionRange(input, selectionStart, selectionEnd) 
{
    if (input.setSelectionRange) 
    {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    }
    else if (input.createTextRange) 
    {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd("character", selectionEnd);
        range.moveStart("character", selectionStart);
        range.select();
    }
}

function wpavk_setCaretToPos(input, pos) 
{
    wpavk_setSelectionRange(input, pos, pos);
}



function wpavk_getCaret(el) {

  if (el.selectionStart) { 
	return el.selectionStart; 
	
  } else if (document.selection) { 
	
	el.focus(); 
	var r = document.selection.createRange(); 
	
	if (r == null) { 
	  return 0; 
	} 
		
	var re = el.createTextRange(), 
	rc = re.duplicate(); 

	re.moveToBookmark(r.getBookmark()); 
	rc.setEndPoint("EndToStart", re); 

	var add_newlines = 0;
	for (var i=0; i<rc.text.length; i++) {
	  if (rc.text.substr(i, 2) == "\r\n") {
		add_newlines += 2;
		i++;
	  }
	}

	return rc.text.length + add_newlines; 
  }  
  return 0; 
}	


var t=0;
var v=0;
var s=0;


function wpavk_trans(p){
var en2ar=new Array(
	"W","Ù‹",
	"3","Ø¹",
	"a","Ø§",  
	"b","Ø¨","p","Ø¨",  
	"t","Øª",
	"7","Ø­",
	"c","Ø«","Ø³Ø³","Ø«","Øª'","Ø«",  
	"j","Ø¬",
	"Ø­'","Ø®","x","Ø®","5","Ø®",
	"k","Ùƒ",  
	"d","Ø¯",  
	"Ø¯'","Ø°", 
	"r","Ø±",  
	"z","Ø²","Ø±'","Ø²",  "R","Ø²",
	"s","Ø³", 
	"Ø«Ù‡","Ø´","Ø³'","Ø´",
	"S","Øµ","9","Øµ",
	"Øµ'","Ø¶","D","Ø¶","9'","Ø¶",
	"T","Ø·","6","Ø·",
	"Ø·'","Ø¸","Z","Ø¸", 
	"Ø¹'","Øº","gÙ‡","Øº","Ø¹'","Øº","gÙ‡","Øº",
	"f","Ù","v","Ù",
	"Ùƒ'","Ù‚","K","Ù‚","q","Ù‚", 
	"l","Ù„",
	"m","Ù…",
	"n","Ù†",
	"h","Ù‡",
	"w","Ùˆ","o","Ùˆ","u","Ùˆ",
	"y","ÙŠ","i","ÙŠ",
	"e","Ø¢",
	"Ùˆ'","Ø¤","ÙˆØ¡","Ø¤",
	"Ø¡ÙŠ","Ø¦","Ø¡#","Ø¦", "ÙŠ'","Ø¦",
	"#","Ù‰", "Ø¢Ø¢","Ù‰", 
	"Ø§Ø¡Ø¡","Ø¥","I","Ø¥","A","Ø¥",
	"Ø¡Ø§","Ø£","Ø§'","Ø£",
	"_","Ù€",
	"2","Ø¡","-","Ø¡",
	"Ù‡'","Ø©", "H","Ø©",
	//7arakat
	"Ø§=","ÙŽ", 
	"Ùˆ=","Ù", 
	"ÙŠ=","Ù",
	"ÙˆÙ†=","ÙŒ",
	"ÙŠÙ†=","Ù",
	"Ø§Ù†=","Ù‹",
	"1","Ø£",
	"Ø¡Ø¡Ø¡","Ù€Ù€Ù€Ù€Ù€Ù€"
);
 
	
	
	for(i=0;i<en2ar.length;i=i+2){
		p=p.replace(en2ar[i],en2ar[i+1]);
	}
	return p;
	
}	

function wpavk_virtual(br){
var en2ar=new Array(	
	"1","Ù¡",
	"2","Ù¢",
	"3","Ù£",
	"4","Ù¤",
	"5","Ù¥",
	"6","Ù¦",
	"7","Ù§",
	"8","Ù¨",
	"9","Ù©",
	"0","Ù ",
	"q","Ø¶",
	"w","Øµ",
	"e","Ø«",
	"r","Ù‚",
	"t","Ù",
	"y","Øº", 
	"u","Ø¹",
	"i","Ù‡",
	"o","Ø®",
	"p","Ø­",
	'{','Ø¬', '[','Ø¬', 
	"}","Ø¯", "]","Ø¯", 
	"a","Ø´",
	"s","Ø³",
	"d","ÙŠ",
	"f","Ø¨",
	"g","Ù„",
	"h","Ø§",
	"j","Øª",
	"k","Ù†",
	"l","Ù…",  
	";","Ùƒ",
	"\'","Ø·", 
	"z","Ø¦",  
	"x","Ø¡",
	"c","Ø¤",
	"v","Ø±",".","Ø²",
	"b","Ù„Ø§", 
	"n","Ù‰",
	"m","Ø©",
	"<","Ùˆ",
	",","Ùˆ",
	"-","Ø¸","/","Ø¸",
	"D","Ø°","Y","Ø¥","Q","ÙŽ","W","Ù‹","E","Ù","A","Ù","S","Ù",
	"G","Ù„Ø£","H","Ø£","T","Ù„Ø¥","Y","Ø¥","B","Ù„Ø¢","N","Ø¢","J","Ù€","K","ØŒ",
	//German 
	"Ã¤","Ø·","Ã¶","Ùƒ","Ã¼","Ø¬", "+","Ø¯" 
	);
 
	
  
	for(i=0;i<en2ar.length;i=i+2){
		br=br.replace(en2ar[i],en2ar[i+1]); 
	}			
	return br;
}	


var timeout    = 300; 
var closetimer = 0;
var ddmenuitem = 0;
var ok=0;

function wpavk_jsddm_open()
{  wpavk_jsddm_canceltimer();
   wpavk_jsddm_close();
    ddmenuitem = jQuery(this).find('ul').css('visibility', 'visible');
}
function wpavk_jsddm_close()
{  
	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');
}

function wpavk_jsddm_timer()
{  
	closetimer = window.setTimeout(wpavk_jsddm_close, timeout)
}

function wpavk_jsddm_canceltimer()
{  if(closetimer)
   {  window.clearTimeout(closetimer);
      closetimer = null;
   }
}


function wpavk_op(el){
	var input=wpavk_sl("area").value;
	var encode = encodeURI(input);
 if(el=="back"){
 		var target = wpavk_sl("area");
		target.focus();
        if (target.setSelectionRange) {
			 var srt = target.selectionStart;
			 var len = target.selectionEnd;
			 if (srt < len) srt++;
			 target.value = target.value.substr(0, srt - 1) + 
			 target.value.substr(len);
			 target.setSelectionRange(srt - 1, srt - 1);
			 target.focus();
        } else 
			if (target.createTextRange) {
		 		self.VKI_range = document.selection.createRange();
         		try { self.VKI_range.select(); } 
				catch(e) {}
				  	self.VKI_range = document.selection.createRange();
				  	if (!self.VKI_range.text.length) 
				  	self.VKI_range.moveStart('character', -1);
				  	self.VKI_range.text = "";
				  	target.focus(); 
			}	
		else target.value = target.value.substr(0, target.value.length - 1);
		     target.focus();
			return true;
 
  }
  else if(el=="search"){  
	 wpavk_sl("sbi").value = input;
	 wpavk_sl('sbi').style.borderColor='#55B5ED';
  }
  else if(el=="google"){  
	MeinFenster = window.open("http://www.google.com/search?ie=UTF-8&oe=utf-8&q="+encode);
	
   }
    else if(el=="ssg"){
   }
    else if(el=="youtube"){
 		MeinFenster = window.open("http://www.youtube.com/results?search_type=&search_query="+encode);
   }
   
    else{
  }
}
 


function wpavk_showChar(e){
	var h;
	if(document.selection){
	var g=window.event.keyCode;} else {
	var g=e.charCode;}
	var t=String.fromCharCode(g);
	switch (t) {
		case "3": tip = " 3'=&#1594; ";break;
		case "2": tip = " ee = &#1609; /  i' = &#1574; / o' =  &#1572; " ;break;
		case "a": tip = " # = Ù‰ / a = &#1575; / a' = &#1571; / A = &#1573;  ";break;
		case "b": tip = " p = &#1576;  ";break;
		case "c": tip = " s = &#1587;  /  ss = &#1579; ";break;
		case "h": tip = " 7' = Ø®   /  x = Ø®  / H = Ø© ";break;
		case "7": tip = " 7' = Ø®    ";break;
		case "k": tip = " q = &#1602; ";break;
		case "g": tip = " j = &#1580; ";break;
		case "q": tip = " k = &#1603; ";break;
		case "d": tip = " d' = &#1584; / D = &#1590;";break;
		case "e": tip = " 2 = &#1569; /  i' = &#1574; / o' =  &#1572;";break;
		case "r": tip = " r' = &#1586;  / R = &#1586; ";break;
		case "s": tip = " c = &#1579; / S = &#1589; / ch = &#1588;  ";break;
		case "9": tip = " ch = &#1588;  / s' = &#1588; / S = &#1589;";break;
		case "i": tip = " A = &#1573;  / i = &#1610; / y = &#1610;";break;
		case "y": tip = " A = &#1573;  / i = &#1610; / y = &#1610;";break;
		case "z": tip = " d' = &#1584; / r' = &#1586; / R = &#1586;";break;
		case "t": tip = " T = &#1591;  / T' = &#1592; / t' = &#1579;";break;
		default:  tip ="";  
	}
 	wpavk_sl("hinweis").innerHTML=tip;
}


/*(function($){
	var textarea,staticOffset;
	var iLastMousePos=0;var iMin=32;var grip;$.fn.TextAreaResizer=function(){return this.each(function(){textarea=$(this).addClass('processed'),staticOffset=null;$(this).wrap('<div class="resizable-textarea"><span></span></div>').parent().append($('<div class="grippie"></div>').bind("mousedown",{el:this},startDrag));var grippie=$('div.grippie',$(this).parent())[0];grippie.style.marginRight=(grippie.offsetWidth-$(this)[0].offsetWidth)+'px'})};function startDrag(e){textarea=$(e.data.el);textarea.blur();iLastMousePos=mousePosition(e).y;staticOffset=textarea.height()-iLastMousePos;textarea.css('opacity',0.25);$(document).mousemove(performDrag).mouseup(endDrag);return false}function performDrag(e){var iThisMousePos=mousePosition(e).y;var iMousePos=staticOffset+iThisMousePos;if(iLastMousePos>=(iThisMousePos)){iMousePos-=5}iLastMousePos=iThisMousePos;iMousePos=Math.max(iMin,iMousePos);textarea.height(iMousePos+'px');if(iMousePos<iMin){endDrag(e)}return false}function endDrag(e){$(document).unbind('mousemove',performDrag).unbind('mouseup',endDrag);textarea.css('opacity',1);textarea.focus();textarea=null;staticOffset=null;iLastMousePos=0}function mousePosition(e){return{x:e.clientX+document.documentElement.scrollLeft,y:e.clientY+document.documentElement.scrollTop}}})($);*/


jQuery(document).ready(function($) {	
	jQuery('div#wpvrk_keyboard_main_wrapper div#areawrapper textarea#area').focus();
	//jQuery('textarea.resizable:not(.processed)').TextAreaResizer();
	
 
	
	jQuery('ul#asdfg li a#caps').zclip({
		path:wpvrk_site_url+'/wp-content/plugins/wp-arabic-virtual-keyboard/js/ZeroClipboard.swf',
		copy:jQuery('textarea#area').val()
	});
 

 	jQuery("div#keyboard ul li a.key").on('click', function() {
		
		jQuery('ul#asdfg li a#caps').zclip({
			path:wpvrk_site_url+'/wp-content/plugins/wp-arabic-virtual-keyboard/js/ZeroClipboard.swf',
			copy:jQuery('textarea#area').val()
		});
	});

});



