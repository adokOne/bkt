$.Controller("AdminGridController",{
	init:function(){
		console.log("wefewfew")
	},

	".sorting -> click":function(ev){
		ev.preventDefault()
		el = $(ev.target)
		type  = el.data('type')
		value = el.data('value')
		this.element.find("input[name="+type+"]").val(value);
		console.log(type)
		if(type=='role')
			$('#offset').val(1)
		this.element.submit();
	}
});