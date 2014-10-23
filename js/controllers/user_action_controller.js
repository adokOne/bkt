$.Controller("UsersController",{
  
  click:function(ev){
    ev.preventDefault();
    if(this.element.hasClass("btn-inverse"))
      this.get_user_form()
    else
      form = this.element.parents("#content").find("form")
      form.find("#where").val(this.element.data("role_id"))
      form.submit()
  },
  
  get_user_form:function(){
    $.ajax({
      url:"/admin/users/get_from",
      type:"post",
      dataType:"json",
      success:function(resp){
        
      }
    });
  }
  
});
