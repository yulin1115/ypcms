function showmessage(message,title){
		var content = '<div class="flickr" id="pageStr">'+message+'</div>';

		var btns=[
			{value:" 登 陆 ",onclick:"inserts("+id+")",focus:true},
			{value:" 注 册 ",onclick:"popwin.close()"}
		];
		popwin.showDialog(3,title,content,btns,200,134);
}