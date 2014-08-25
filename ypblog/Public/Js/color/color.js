function ColorPicker(){
	var _t=this;
	var cobj;
	//常用的颜色
	var _comcolor = new Array('#000000', '#333333', '#666666', '#999999','#CCCCCC', '#FFFFFF', '#FF000', '#00FF00','#0000FF', '#FFFF00', '#00FFFF', '#FF00FF','#C0C0C0', '#DEDEDE', '#FFFFFF', '#FFFFFF');

	var _hex = new Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');
	var _cnum = new Array(1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, 0);
	var titleId = '';
	
	_t.choose = function(e,curobj){
		if(typeof curobj == "undefined"){
			_t.titleId = "title";
		}else{
			_t.titleId = curobj;
		}
		
		//获取当前绑定对象
		var obj = document.all ? event.srcElement : e.target;
		//alert(e.id);
		//alert(_t.id);
		obj.style.position = "relative";
		var inputTop = _t.getTop(obj);
		var inputLeft = _t.getLeft(obj);
		var htmlStr = "visibility:visible; position:absolute; padding:2px;border:1px solid #c0c0c0;background:#F0F0F0; cursor:pointer;";
		var _cpicker = document.getElementById("_cpicker");
		if (!_cpicker){
			_cpicker = document.createElement("div");
			_cpicker.id = "_cpicker";
			_cpicker.style.cssText = htmlStr;
			_cpicker.style.zIndex = 30000;
			var _cpickerContent = "<div>"+_t._colorTable()+"<div>" ;
			document.body.appendChild(_cpicker);
			_cpicker.innerHTML = _cpickerContent;
		}
		else {
			document.getElementById("_cpicker").style.visibility = "visible";
		}

		_cpicker.style.left = (inputLeft) + "px";
		_cpicker.style.top = (inputTop + obj.clientHeight) + "px";
		  
		if(!_cpicker.onclick){
			_cpicker.onclick = function(oEvent){
				e = oEvent || window.event;
				//alert(e.target.bgColor);
				var ev = document.all ? event.srcElement : e.target ;
				if(ev.bgColor!=undefined){
					_t.chooseColor(ev.bgColor);
				}else{
					_t.chooseColor("");
				}
				this.style.visibility = "hidden";
				if (document.all) {
					e.cancelBubble = true;
				}
				else {
					e.stopPropagation();
				}

			};
		}

		if(!_cpicker.onmouseover){
			_cpicker.onmouseover = function(oEvent){
				e = oEvent || window.event;
				var ev = document.all ? event.srcElement : e.target ;
				if(ev.bgColor!=undefined){
					_t.previewColor(ev.bgColor);
				}else{
					_t.previewColor("");
				}
			};
		} 

		if(!document.all){
			_cpicker.setAttribute('flag','flag'); 
			obj.setAttribute('flag','flag');
		}else{
			_cpicker.flag = "flag";
			obj.flag = "flag";
		}
	  
		if(!document.onclick){
			document.onclick = function(e){
				var ev = document.all ? event.srcElement : e.target ;

				if (ev.getAttribute("flag")==null){
					document.getElementById("_cpicker").style.visibility = "hidden";
				}
			};
		}

	}

	//Interface
	_t.previewColor = function(color){
		//alert(color);
		document.getElementById("highlightcolor").value = color;
		document.getElementById("highlightcolor").style.color = color;
		document.getElementById(_t.titleId).style.color = color;
		//alert(_t.titleId);
		
	}
	//Interface
	_t.chooseColor = function(color){
		document.getElementById("highlightcolor").value = color;
		document.getElementById("highlightcolor").style.color = color;
		document.getElementById(_t.titleId).style.color = color;
		
	}
	_t._toHex = function(n){
		var h, l;
		n = Math.round(n);
		l = n % 16;
		h = Math.floor((n / 16)) % 16;
		return (_hex[h] + _hex[l]);
	}

	_t._colorTd = function(r, g, b, n){
		r = ((r * 16 + r) * 3 * (15 - n) + 0x80 * n) / 15;
		g = ((g * 16 + g) * 3 * (15 - n) + 0x80 * n) / 15;
		b = ((b * 16 + b) * 3 * (15 - n) + 0x80 * n) / 15;
		return '<TD BGCOLOR="#' + _t._toHex(r) + _t._toHex(g) + _t._toHex(b) + '" height=10 width=10></TD>';
		//return '<TD BGCOLOR="#' +r.toString(16)  + g.toString(16) + b.toString(16) + '" height=1 width=1></TD>';
	}

  
	_t._colorTable =function(){
		var trStr = "<table CELLPADDING=0 CELLSPACING=0>";
		var nStr = "";
		for (i = 0; i < 16; i++) {
			trStr += '<TR>';
			//trStr += '<TD BGCOLOR="#000000"  height=16 width=13></TD>';
			trStr += '<TD BGCOLOR="' + _comcolor[i] + '" height=10 width=10></TD>';
			//trStr += '<TD BGCOLOR="#000000"  height=16 width=13></TD>';
			for (j = 0; j < 30; j++) {
				n1 = j % 5;
				n2 = Math.floor(j / 5) * 3;
				n3 = n2 + 3;
				trStr += _t._colorTd((_cnum[n3] * n1 + _cnum[n2 ] * (5 - n1)), (_cnum[n3 + 1] * n1 + _cnum[n2 + 1] * (5 - n1)), (_cnum[n3 + 2] * n1 + _cnum[n2 + 2] * (5 - n1)), i);
			}
			trStr += '</TR>';
		}
		trStr += "</table>";
		return trStr;
	}
	
	_t._colorTables =function(){
		var trStr = "<table CELLPADDING=0 CELLSPACING=0>";
		var nStr = "";
			for (j = 0; j < 50; j++) {
				n1 = j;
				trStr += '<TR>';
				for(m = 0; m < 50; m++){
					n2 = m;
					for(n = 0; n < 12; n++){
						n3 = n;
						trStr += _t._colorTd(n1, n2, n3 ,m);
					}
					
				}
				trStr += '</TR>';
			}
		trStr += "</table>";
		//alert(nStr);
		return trStr;
	}

	_t.getTop = function(e){
		var offset = e.offsetTop;
		if (e.offsetParent != null)
		offset += _t.getTop(e.offsetParent);
		return offset;
	}
	
	_t.getLeft = function(e){
		var offset = e.offsetLeft;
		if (e.offsetParent != null) 
		offset += _t.getLeft(e.offsetParent);
		return offset;
	}
	
	_t.exOne = function(){
		clr=new Array('00','20','40','60','80','a0','c0','ff');
		document.write("<table CELLPADDING=0 CELLSPACING=0>");
		for (i=0;i<8;i++) {
			
			for (j=0;j<8;j++) {
				document.write("<tr>"); 
				for (k=0;k<8;k++) {
					document.write('<td width="16px" height="16px" bgcolor="#'+clr[7-i]+clr[7-j]+clr[7-k]+'">');
					document.write('</td>'); 
				}
				document.write("</tr>"); 
			}
			
		}
		document.write("</table>");
	}
}

var colorpicker=new ColorPicker();