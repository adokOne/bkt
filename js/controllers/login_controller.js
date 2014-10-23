$.Controller('LoginController',{
	init:function(){
		this.set_submit();
	},
	set_submit:function(){
		self = this
		this.element.ajaxForm({
			dataType:'json',
			success:function(resp){
				if(resp.status)
					window.location.reload();
				else
					self.show_errors(resp.text);
					
			}
		});
	},
	show_errors:function(text){
		field = this.element.prev();
		old   = field.text();
		field.html(text).css('color','red').show();
		self = this
		setTimeout('self.remove_error(field,old)',1200);
	},
	remove_error:function(field,text){
		field.css('color','#646464');
		field.html(text);
	}
	
	
});