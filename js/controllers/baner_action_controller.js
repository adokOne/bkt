$.Controller("BanerController",{
  init: function(){
    if(this.element.hasClass("btn-danger"))
      this.setup_upload()
  },
  click: function(ev){
    if(!this.element.hasClass("btn-danger")){
    ev.preventDefault()
    this.element.parents(".btn_block").hide()
    this.load_form()
    $("#content").find('form').hide()
    }

  },
  load_form:function(){
    $.ajax({
      url:"/admin/baner/get_form",
      dataType:"json",
      success:function(resp){
        $("#content").append(resp.html)
        $("#content").find('.page_edit').attachBanerFormController()
      }
    });
  },
  setup_upload:function(){
   
    this.element.attr("id",'btn_upload_top')
    el    = this.element.find('#btn_upload_top');

    var uploader = new qq.FileUploader({
                element: document.getElementById('btn_upload_top'),
                failedUploadTextDisplay: '',
                buttonTitle:"",
                buttonText:"",
                action: '/admin/baner/upload_top_image/',
                uploadButtonText: el.text(),
                debug: true,
                onSubmit: function(id, filename) {
                  $('.qq-upload-list').remove();
                },
                onComplete: function(id, fileName, response) {
                  
                  if(response.success){
                    //img.attr("src","/upload/tmp/"+response.file+"?"+Math.random().toString(36).substring(7)).show();
                    //$('#_image_name').val(response.file)
                    alert("Картинка завантажена")
                  }
                  else{
                    alert(response.error);
                    
                  }
                  
 
                }
            });
    this.element.find(".qq-upload-button").contents().first().replaceWith("Додати банер зверху")
    
  },
});

$.Controller("baner_action_controller",{
  init:function(){
    this.row_id = this.element.parent().find('td').eq(0).text()
   this.element.find('.btn-success').attr("id","btn_upload_" + Number(this.row_id))
   
    this.setup_upload()
    
  },
  
  delete_row:function(id){
    $.ajax({
      url:"/admin/baner/delete/",
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
      url:"/admin/baner/get_form/",
      type:"post",
      data:"id="+id,
      dataType:"json",
      success:function(resp){
      $(".btn_block").hide()
       $("#content").find('form').hide()
        $("#content").append(resp.html)
        $("#content").find('.page_edit').attachBanerFormController()
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
  },


  setup_upload:function(){
    img   = this.element.find('.b_photo img');
    el    = this.element.find('#btn_upload_' + this.row_id);
    id = this.row_id
    console.log("ggggggggg")
   /* if(!img.hasClass("show"))
      img.hide();*/
      for(i = 0; i <$(".btn-success").length;i++){
        console.log(i)
      }
    var uploader = new qq.FileUploader({
                element: document.getElementById('btn_upload_' + Number(id)),
                failedUploadTextDisplay: '',
                buttonTitle:"",
                buttonText:"",
                action: '/admin/baner/upload_image/'+id,
                uploadButtonText: el.text(),
                debug: true,
                onSubmit: function(id, filename) {
                  $('.qq-upload-list').remove();
                },
                onComplete: function(id, fileName, response) {
                  
                  if(response.success){
                    //img.attr("src","/upload/tmp/"+response.file+"?"+Math.random().toString(36).substring(7)).show();
                    //$('#_image_name').val(response.file)
                    alert("Картинка завантажена")
                  }
                  else{
                    alert(response.error);
                    
                  }
                  
 
                }
            });
    this.element.find(".qq-upload-button").contents().first().replaceWith("Картинка")
    
  },

  
});
$.Controller("BanerFormController",{
  init: function(){

  },
  
  ".btn.btn-warning -> click":function(ev){
    ev.preventDefault()
    el   = $(ev.target)
    if(el.hasClass("active"))
      return
    btns = $(".btn.btn-warning")
    idx  = btns.index(el)
    btns.removeClass("active")
    el.addClass("active")
    this.element.find(".control-group").hide()
    this.element.find(".control-group._"+idx).show()
  },
  
  ".btn -> click":function(ev){
    ev.preventDefault()
   
    el = $(ev.target).hasClass("btn") ? $(ev.target) : $(ev.target).parents(".btn")
    if(!el.hasClass('btn-primary') && !el.hasClass('btn-warning')){
      $('.page_edit').remove();
      $("#content").find('form').show();
      $(".btn_block").show()
    }
    if(el.hasClass("save"))
      this.edit_price('save')
  },
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },

  edit_price:function(action){
    form = this.element.find(".page_save")
    $.ajax({
      url:"/admin/baner/"+action,
      dataType:"json",
      type:"post",
      data:form.serialize(),
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    })
  }
});