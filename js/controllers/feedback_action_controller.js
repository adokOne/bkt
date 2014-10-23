$.Controller("feedback_action_controller",{
  init:function(){
    this.element.find('.btn-success').remove()
    //this.element.find('.btn-info').remove()
    this.row_id = this.element.parent().find('td').eq(0).text()
  },
  
  delete_row:function(id){
    $.ajax({
      url:"/admin/feedbacks/delete/",
      data:"id="+id,
      type:"post",
      dataType:"json",
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    });
  },

  comment_row:function(id){
    $.ajax({
      type:"post",
      url:"/admin/feedbacks/get_form/",
      dataType:"json",
      data:"id="+id,
      success:function(resp){
        $("body").append(resp.html);
        $('body').find('.modal').attachFeedFormController()
        $(".modal").draggable({
            handle: ".modal-header"
        });



      }
    })
  },
  
  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    if(confirm("Точно видалити данні?"))
      this.delete_row(this.row_id)
  },

  ".btn-info -> click":function(ev){
    ev.preventDefault()
    this.comment_row(this.row_id)
  },

  ".icon-edit -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target)
    this.get_edit_form(this.row_id)
  }
  
});

$.Controller("FeedFormController",{
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },

  ".btn-primary -> click":function(ev){
    ev.preventDefault()
    this.save_prepare()
  },

  save_prepare:function(){
    form = this.element.find("form")
    $.ajax({
      url:"/admin/feedbacks/save_comment",
      dataType:"json",
      type:"post",
      data:form.serialize(),
      success:function(resp){
        if(resp.success){
          alert("Збережно")
          $(".modal").remove()
        }
          
      }
    })
  }

})