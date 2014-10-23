$.Controller("blog_com_action_controller",{
  init:function(){
    this.row_id = this.element.data("id")
  },
  
  delete_row:function(id){
    $.ajax({
      url:"/admin/blog/delete_comment/",
      data:"id="+id,
      type:"post",
      dataType:"json",
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    });
  },

  
  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    if(confirm("Точно видалити данні?"))
      this.delete_row(this.row_id)
  },

  
});

