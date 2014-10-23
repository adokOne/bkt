$.Controller("schedule_action_controller",{
  init:function(){
    this.element.find('.btn-success').remove()
    this.row_id = this.element.parent().find('td').eq(0).text()
  },
  
  delete_row:function(id){
    $.ajax({
      url:"/admin/schedule/delete/",
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
      url:"/admin/schedule/get_form/",
      type:"post",
      data:"id="+id,
      dataType:"json",
      success:function(resp){
        $('body').append(resp.html)
        $('body').find('.modal').attachScheduleFormController();
          for(i in resp.data){
            $('.form_edit').find("#_"+i).val(resp.data[i]).change()
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
