$.Controller("page_action_controller",{
  init:function(){
    this.element.find('.btn-success').remove()
    this.row_id = this.element.parent().find('td').eq(0).text()
  },
  
  delete_row:function(id){
    $.ajax({
      url:"/admin/pages/delete/",
      data:"id="+id,
      type:"post",
      dataType:"json",
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    });
  },
  get_edit_form:function(id){
    self = this
    $.ajax({
      url:"/admin/pages/get_form/",
      type:"post",
      data:"id="+id,
      dataType:"json",
      success:function(resp){
      $(".btn_block").hide()
       $("#content").find('form').hide()
        $("#content").append(resp.html)
        $("#content").find('.page_edit').attachPagesFormController()
        console.log(resp.data)
          for(i in resp.data){
            $('.page_save').find("#_"+i).val(resp.data[i]).change()
          }
      }
    });
  },
  
  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    if(confirm("Точно видалити данні?"))
      this.delete_row(this.row_id)
  },
  ".icon-edit -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target)
    this.get_edit_form(this.row_id)
  }
  
});
