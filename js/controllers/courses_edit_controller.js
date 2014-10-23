$.Controller("CoursesEditController",{
  init:function(){
    this._id = 0;
    $(".btn_block").remove()
  },
  "#pidgotovka -> click":function(ev){
    ev.preventDefault()
    this.get_prepare_form(this._id)
  },

  get_prepare_form:function(id){
    $.ajax({
      url:"/admin/courses/get_prepare_form/",
      type:"post",
      data:"id="+id,
      dataType:"json",
      success:function(reps){
        $("body").append(reps.html);
        $('body').find('.modal').attachPrepareFormController()
      }
    })
  },
  ".course -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target)
    if(el.hasClass('active'))
       return
    id = el.attr("href").split("_")[1]
    this.element.find(".course").removeClass("active");
    el.addClass("active")
    this.element.find(".box.span12").show()
    this.element.find(".box.span12").eq(1).find(".btn-danger").show()
    this._id = id
    window.location.hash = "_"+id
    this.get_course(id)
  },
  
  
  ".btn-info -> click":function(ev){
    ev.preventDefault()
    this.edit_course("save")
  },
  
  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    if(confirm("Ця, вкладені категорії, та вся інформація яка з ними повязана будуть видалені"))
    this.edit_course("delete")
  },

 ".btn-warning -> click":function(ev){
  ev.preventDefault()
  this.get_plan()
 },

  setup_upload:function(){
    img   = this.element.find('.b_photo img');
    el    = this.element.find('#btn_upload');
   /* if(!img.hasClass("show"))
      img.hide();*/
    id = this._id
    var uploader = new qq.FileUploader({
                element: document.getElementById('btn_upload'),
                failedUploadTextDisplay: '',
                buttonTitle:"",
                buttonText:"",
                action: '/admin/courses/upload_image/',
                uploadButtonText: el.text(),
                debug: true,
                onSubmit: function(id, filename) {
                  $('.qq-upload-list').remove();
                },
                onComplete: function(id, fileName, response) {
                  
                  if(response.success){
                    img.attr("src","/upload/tmp/"+response.file+"?"+Math.random().toString(36).substring(7)).show();
                    $('#_image_name').val(response.file)
                  }
                  else{
                    alert(response.error);
                    
                  }
                  
 
                }
            });
    $(".qq-upload-button").contents().first().replaceWith("Картинка")
    


    el    = this.element.find('#present_button');

    var uploader = new qq.FileUploader({
                element: document.getElementById('present_button'),
                failedUploadTextDisplay: '',
                buttonTitle:"",
                buttonText:"",
                action: '/admin/courses/upload_present/'  + id,
                uploadButtonText: el.text(),
                debug: true,
                onSubmit: function(id, filename) {
                  $('.qq-upload-list').remove();
                },
                onComplete: function(id, fileName, response) {
                  
                  if(response.success){
                    alert("Презентацію завантажено");
                  }
                  else{
                    alert(response.error);
                    
                  }
                  
 
                }
            });
    $(".qq-upload-button:eq(1)").contents().first().replaceWith("Завантажити презентацію")





  },

 get_plan:function(){
  id = this._id
    self = this;
    $.ajax({
      url:"/admin/courses/get_plan",
      dataType:"json",
      data: "id="+id,
      type:"post",
      success:function(resp){
        $('body').append(resp.html)
        $('body').find('.modal').attachCourseFormController()
$(".modal").draggable({
    handle: ".modal-header"
});
    }

  })
  
 },
  ".groups -> click":function(ev){
    ev.preventDefault();
    this.edit_groups();
  },

  edit_groups:function(){
    id = this._id
    self = this;
    $.ajax({
      url:"/admin/courses/get_groups",
      dataType:"json",
      data: "id="+id,
      type:"post",
      success:function(resp){
        $('body').append(resp.html)
        $('body').find('.modal').attachCourseGroupsController()
$(".modal").draggable({
    handle: ".modal-header"
});

    }

  })
  },

".get_text -> click":function(ev){
ev.preventDefault();
$("#text_form").remove();
 $.ajax({
  url:"/admin/courses/text_window",
  dataType:"json",
  success:function(resp){
   $('body').append(resp.html)
   $("#text_form").draggable({
       handle: ".modal-header"
   });
$("#text_form").show();
}

});







},
  
  ".btn-inverse -> click":function(ev){
    ev.preventDefault();
    if($(ev.target).hasClass("groups"))
      return;
    else{
      this.element.find(".box.span12").show()
      this.element.find(".box.span12").eq(1).find(".btn-danger").hide()
      this.element.find("input").each(function(i,el){
        $(el).val("")
      })
      this.element.find("#_src").attr("src","/upload/")
    }
  },


  ".btn-link -> click":function(ev){
     ev.preventDefault();
     this.get_data();
  },
  get_data:function(){
    id = this._id
    $.ajax({
      url:"/admin/courses/get_page_form",
      dataType:"json",
      data: "id="+id,
      type:"post",
      success:function(resp){
        if(resp.success){
            $("#content form:eq(0)").hide()
            $("#content").append(resp.html)
            $("#content").find('.page_edit').attachPagesFormController()
            for(i in resp.data){
              $('.page_save').find("#_"+i).val(resp.data[i]).change()
            }
          }
        }
    })


  },
  
  /*".image -> click":function(ev){
    ev.preventDefault();
  },*/
  get_course:function(id){
    self = this;
    $.ajax({
      url:"/admin/courses/get",
      dataType:"json",
      data: "id="+id,
      type:"post",
      success:function(resp){
        if(resp.success){
          for(i in resp.data){
            self.element.find("#_"+i).val(resp.data[i]).change()
            self.element.find("#_"+i).attr("src","/upload/"+resp.data[i]+"?"+Math.random().toString(36).substring(7))
            self.setup_upload();
          }
        }
      }
    })
  },
  
  
  edit_course:function(action){
    form = this.element.find(".form-horizontal.form_edit")
    $.ajax({
      url:"/admin/courses/"+action,
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

$.Controller("CourseFormController",{
init:function(){
  if(this.element.find("#_course_id").val() == "")
    this.element.find("#_course_id").val(window.location.hash.replace("#_",""))
},
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },


  ".btn -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    if(el.hasClass('close'))
      el.parents('.modal').remove();
    else if(el.hasClass("btn-warning"))
      this.add_theme()
    else if(el.hasClass("btn-primary"))
      this.save_plan()
    else
      console.log("no action")
  },
 ".btn-success -> click":function(ev){
    ev.preventDefault()
    this.load_themes($(ev.target).data("id"))
 },
 load_themes:function(id){
    __self = this;
    $.ajax({
      url:"/admin/courses/get_themes",
      dataType:"json",
      data: "id="+id,
      type:"post",
      success:function(resp){
        if(resp.success){
        $('body').append(resp.html)
        $('body').find('.modal').attachCourseThemeController();
$(".modal").draggable({
    handle: ".modal-header"
});
        }
      }
    })
 },
  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents(".control-group").remove()
    __self = this
    this.element.find("form .control-group").each(function(){
      $(this).find(".control-label").html("Тема "+(1 + __self.element.find("form .control-group").index($(this))))
    })
  },

  add_theme:function(){
    el = this.element.find(".control-group:eq(0)").clone()
    id = this.element.find('form').find(".control-group").length + 1
    el.find(".control-label").html("Тема "+id)
    el.find("input").val("")
    el.find("input").eq(0).attr("name","name["+id+"][ru]")
    el.find("input").eq(1).attr("name","name["+id+"][ua]")
    
    this.element.find("fieldset").append(el)
  },

  save_plan:function(){
    form = this.element.find(".form-horizontal.form_edit")
    $.ajax({
      url:"/admin/courses/save_plan",
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
});

$.Controller("CourseThemeController",{
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },

  ".btn -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    if(el.hasClass('close'))
      el.parents('.modal').remove();
    else if(el.hasClass("btn-warning"))
      this.add_theme()
    else if(el.hasClass("btn-primary"))
      this.save_plan()
    else
      console.log("no action")
  },
  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents(".control-group").remove()
    __self = this
    this.element.find("form .control-group").each(function(){
      $(this).find(".control-label").html("Пункт "+(1 + __self.element.find("form .control-group").index($(this))))
    })
  },

  add_theme:function(){
    el = this.element.find(".control-group:eq(0)").clone()
    id = this.element.find('form').find(".control-group").length + 1
    el.find(".control-label").html("Пункт "+id)
    el.find("input").val("")
    el.find("input").eq(0).attr("name","name["+id+"][ru]")
    el.find("input").eq(1).attr("name","name["+id+"][ua]")
    
    this.element.find("fieldset").append(el)
  },

  save_plan:function(){
    form = this.element.find(".form-horizontal.form_edit")
    ___self = this
    $.ajax({
      url:"/admin/courses/save_planthemes",
      dataType:"json",
      type:"post",
      data:form.serialize(),
      success:function(resp){
        if(resp.success){
          alert("Збережно")
          ___self.element.remove()
        }
          
      }
    })
  }
});

$.Controller("CourseGroupsController",{
  init:function(){
$(".modal").draggable({
    handle: ".modal-header"
});
  },
  ".btn-success -> click":function(ev){
    ev.preventDefault()
    id = $(ev.target).parents(".control-group").data("id")
    this.get_groups(id)

  },
  ".btn-warning -> click":function(ev){
    ev.preventDefault()
    this.get_groups(0)

  },


  get_groups:function(id){
    c_id = this.element.data("course_id")
    $.ajax({
      url:"/admin/courses/get_group_form",
      dataType:"json",
      type:"post",
      data:"id="+id+"&course_id="+c_id,
      success:function(resp){
        if(resp.success){
          $('body').append(resp.html)

          $('body').find('.modal').attachScheduleFormController();
$(".modal").draggable({
    handle: ".modal-header"
});
          for(i in resp.data){
            $('.form_edit').find("#_"+i).val(resp.data[i]).change()
          }
        }
          
      }
    })
  },

  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    id = $(ev.target).parents(".control-group").data("id")
    $(ev.target).parents(".control-group").remove()
    
    this.delete_group(id)
    this.element.find(".g_lab").each(function(){
      $(this).html("Група "+(1 + $(".g_lab").index($(this))))
    })
  },
  delete_group:function(ed){
    $.ajax({
      url:"/admin/courses/gelete_group",
      dataType:"json",
      type:"post",
      data:"id="+id,
      success:function(resp){
        if(resp.success){
          alert("Збережно")
        }
          
      }
    })
  },

  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },
});

$.Controller("ScheduleFormController",{
  init: function(){
     this.element.find("#_start_date").datepicker({dateFormat:"yy-mm-dd"})
    this.element.find("#_time_from").timepicker({
      hourMin: 8,
      hourMax: 22
    });
    this.element.find("#_time_to").timepicker({
      hourMin: 8,
      hourMax: 22
    });
  },
  ".btn -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    if(!el.hasClass('btn-primary'))
      el.parents('.modal').remove();
    else
      this.edit_price('save')
  },
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },
  edit_price:function(action){
    form = this.element.find(".form-horizontal.form_edit")
    $.ajax({
      url:"/admin/courses/save_group",
      dataType:"json",
      type:"post",
      data:form.serialize(),
      success:function(resp){
        if(resp.success){
          alert("Збережено")
          $(".modal").remove()
        }
          
      }
    })
  }
});
function getSelectionText() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}
function wrapText(elementID, openTag, closeTag) {
    var textArea = $('#' + elementID);
    var len = textArea.val().length;
    var start = textArea[0].selectionStart;
    var end = textArea[0].selectionEnd;
    var selectedText = textArea.val().substring(start, end);
    var replacement = openTag + selectedText + closeTag;
    textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
}
$.Controller("PagesFormController",{
  init: function(){
    /*this.element.find("textarea.cleditor").cleditor({
      width: "100%",
      height: "500px"
    });*/
    this._area_id = "_text_0"
    this.element.find(".control-group").hide()
    this.element.find(".control-group._0").show()
    this.element.find(".btn.btn-warning:eq(0)").addClass("active")
  },

  ".btn.btn-inverse -> click":function(ev){
    ev.preventDefault()
    this._area_id
    wrapText(this._area_id,"<strong>", "</strong>")
    //text = "<strong>"+getSelectionText()+"</strong>"
    
  },
  
  ".btn.btn-warning -> click":function(ev){
    ev.preventDefault()
    el   = $(ev.target)
    if(el.hasClass("active"))
      return
    btns = this.element.find(".btn.btn-warning")
    idx  = btns.index(el)
    this._area_id = "_text_" + idx
    btns.removeClass("active")
    el.addClass("active")
    this.element.find(".control-group").hide()
    this.element.find(".control-group._"+idx).show()
  },
  
  ".btn -> click":function(ev){
    ev.preventDefault()
   
    el = $(ev.target).hasClass("btn") ? $(ev.target) : $(ev.target).parents(".btn")
    if(!el.hasClass('btn-primary') && !el.hasClass('btn-warning') && !el.hasClass('btn-inverse') ){
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
      url:"/admin/courses/save_page",
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



$.Controller("PrepareFormController",{
  init:function(){
$(".modal").draggable({
    handle: ".modal-header"
});
  },
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },
  ".btn-inverse -> click":function(ev){
    ev.preventDefault()
    var url=prompt("Введи ссилку на куср","Тра ля ля");
    id = "text_" + $(ev.target).attr("href")
    if (url!=null && url!="")
    {
      wrapText(id,'<a href="'+url+'"">','</a>')
    }
  },
  ".btn-primary -> click":function(ev){
    ev.preventDefault()
    this.save_prepare()
  },
  save_prepare:function(){
    form = this.element.find(".form-horizontal.form_edit")
    $.ajax({
      url:"/admin/courses/save_prepare",
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

});