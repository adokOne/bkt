<script type='text/javascript'>
    var tileIcons = new Ext.XTemplate(
        '<div class="x-grid3-row ux-explorerview-item ux-explorerview-tiles-item">',
        '<div class="ux-explorerview-icon"><div class="doc"><img src="'+Ext.BLANK_IMAGE_URL+'" /></div></div>',
        '<div class="ux-explorerview-text"><div class="x-grid3-cell x-grid3-td-name" unselectable="on">{pa_name}<br><span>{type} / {pa_size} Kb</span></div></div></div>'
    );

    
    var getSendVariables = function(arrFormVariables){
		var paramArray = new Array();
		for(var lp1=0; lp1<arrFormVariables.length; lp1++){		
			
			if(typeof(Ext.getCmp(arrFormVariables[lp1]))!='undefined'){
				
				switch(Ext.getCmp(arrFormVariables[lp1]).getXType()){
					case 'checkbox': 
						paramArray.push("'" + arrFormData[lp1] + "': '" + (Ext.getCmp(arrFormData[lp1]).getValue() ? '1' : '0') + "'");
						break;						
						
					default:						
						paramArray.push("'" + arrFormVariables[lp1] + "': '" + terminatedString(Ext.getCmp(arrFormVariables[lp1]).getValue()) + "'");
						break;        					
				}				
				

			}
			
		}  
		console.log(paramArray);
		return Ext.util.JSON.decode('{' + paramArray.join(',') + '}')  	;
    	
    };
    var setActiveTabCool = function(objTabPanel, indexTab){
        try{
            objTabPanel.setActiveTab(indexTab);
          } catch(e) {
            objTabPanel.setActiveTab(0);
            objTabPanel.setActiveTab(indexTab);
          }
    }
    
    var loadAfterLoad = function(arrFormVariables, formReader, flagNew){        
        for(var lp1=0; lp1<arrFormVariables.length; lp1++){    
            if(typeof(Ext.getCmp(arrFormVariables[lp1]))!='undefined'){                
                if(!flagNew){
                    eval('var formVal = formReader.jsonData[0].'+arrFormVariables[lp1]);
                } else {
                    var formVal = '';
                }
                Ext.getCmp(arrFormVariables[lp1]).setValue(formVal);
            }
        }
    }
    
	function terminatedString(str){
		var strReplace = String(str);
		
		strReplace = strReplace.replace(/\n/gi,"\\n");
		strReplace = strReplace.replace(/\'/gi,"`");
		strReplace = strReplace.replace(/\’/gi,"`");
		strReplace = strReplace.replace(/\r/gi,"\\r");
	    return strReplace;
		
	} 

	//Сохранить данные грида
    var itemsSave = function (storeObject, url) {   	
        var m = storeObject.getModifiedRecords();
        if(m.length > 0) {
            jsonData = "[";
            for(i=0;i<m.length;i++) {
                record = m[i];
                jsonData += Ext.util.JSON.encode(record.data) + ",";
            }
            jsonData = jsonData.substring(0,jsonData.length-1) + "]";
            
            Ext.Ajax.request({
                url:url,
                success:function(response) {
                    var json = Ext.util.JSON.decode(response.responseText);
                    if(!json.success) {
                        Ext.MessageBox.alert('Помилка', json.msg);                        
                    } else {
                        storeObject.commitChanges();
                        storeObject.reload();
                    }

                },
                params:{
                    'save':jsonData
                }
                        
            });
        } else {
            Ext.MessageBox.alert('Інформація', 'Данні не модифіковані');
        }
    };


    var itemsRemove = function (gridObject, url) {
        var m = gridObject.getSelectionModel().getSelections();    
            
        if(m.length > 0) {
            Ext.MessageBox.confirm('Інформація', 'Ви дійсно хочете видалити вибрані елементи?' , function (btn) {
                if(btn == 'yes') {
                    var jsonData = '[{';
                    for(var i = 0, len = m.length; i < len; i++) {
                        var ss = '"'+i+'":"' + m[i].id + '"';
                        if(i==0) {
                            jsonData = jsonData + ss;
                        } else {
                            jsonData = jsonData + ',' + ss;
                        }
                        gridObject.getStore().remove(m[i]);
                    }
                    jsonData = jsonData + '}]';
                    Ext.Ajax.request({
                        url:url,
                        success:function(response) {
                            var json = Ext.util.JSON.decode(response.responseText);
                            if(!json.success) {
                                Ext.MessageBox.alert('Помилка', json.msg);
                            } else {
                                gridObject.getStore().reload();
                            }

                        },
                        params:{
                            'delete':jsonData
                        }
                    });                    
                }
            });
        } else {
            Ext.MessageBox.alert('Інформація', 'Відсутні вибрані елементи');
        }
    };  
	/*Категорії*/
    var categoriesStore = new Ext.data.Store({
		  proxy:new Ext.data.HttpProxy({
	            url:'/admin/news/list_category'
	        }),
	        reader:new Ext.data.JsonReader({
	            root:'items',
	            totalProperty:'total',
	            idProperty:'n_cat_id',
	            id:'n_cat_id'
	        },["n_cat_id", "n_cat_name"]),
	        remoteSort:true 
	});
	
	var Categorygrid = new Ext.grid.EditorGridPanel({
	   store: categoriesStore,
	  	id:'category_grid',
	   selModel:new Ext.grid.RowSelectionModel({singleSelect:false}),
     sm:new Ext.grid.CheckboxSelectionModel(),  
     cm:new Ext.grid.ColumnModel([
   		  new Ext.grid.CheckboxSelectionModel() ,
	        { 
     	        id: 'n_cat_id',
     	        header: "Id",
     	        width: 20, 
     	        sortable: true,
     	        dataIndex: 'n_cat_id'
          },{ 
              id:'n_cat_name', 
              header: "Название", 
              sortable: false, 
              dataIndex: 'n_cat_name',
              editor: new Ext.form.TextField({
	        		maxLengthText:100,
	           	    allowBlank: false
	       	    })
     	    }
	    ]),
	   viewConfig: {
         forceFit: true
     },
     
     split: true,
	    ds:categoriesStore,
	    stripeRows: true,
	    autoWidth: true,
	    autoHeight: true
	});
	var Windowc= new Ext.FormPanel({

		  url:'/admin/news/add_category',
		  frame: true,
		  items: [
		      {
		          xtype: 'textfield',
		          id: 'n_cat_name',
		          fieldLabel: 'Название',
		          allowBlank:false,
		          anchor: '90%'
		      }
		  ],

		  buttons: [
		      {
		        text: 'Отправить',
		        handler: function() {
		        	Windowc.getForm().submit({
		                waitTitle: 'пожалуйста подождите...',
		                waitMsg: 'Категория создается',
		                success: function(){
		                	Window.destroy();
    		                }
		            });
		        	categoriesStore.load();
		        }
		      }
		  ]
		});
	
	var Window = new Ext.Window({
  		modal: true,
  		title:'Название новой категории',
  		width:330,
  		closable: true,
  		closeAction:'hide',
  		 headerPosition: 'top',
  		items: Windowc
  		});
	
    var CategoryManage=null;
    var CategoryManage = function () {
    	 categoriesStore.load();
    	 win.show();
    };  
   
	   var win = new Ext.Window({
	      applyTo:'win',
	      contentEl:'body',
	      layout:'fit',
	      autoWidth: true,
	      modal: true,
	      defaults: { autoScroll:true,height: 300,width:400},

	      closeAction:'hide',
	      items:[{
            title: 'Категорiї',
            border:false,
            id: 'catlist',
            items: Categorygrid
            
        }],
	      
	      tbar: [
{
xtype: 'buttongroup', 
items:[
      {'text':'Удалить',
          iconCls:'remove', 
          handler:function(){
      	itemsRemove(Categorygrid, '/admin/news/remove_categories');
      	
      	}
      },
      {'text':'Добавить',
        iconCls:'add',
        handler:function(){
      		Window.show();

      	},
      
      
      }
  ]}

],

	      buttons: [{
	        text:'Сохранить',
	        handler:function(){
          	itemsSave(categoriesStore, '/admin/news/save_category');
          	
          }
	      },{
	        text: 'Закрыть',
	        handler: function(){
	          win.hide();
	        }
	      }]
	 });
	  
            	
</script>
<?php 
/*
    widget::render('advert','_count_rent_get',true); 
	{widget name="Widget_admin" action="base_function"}
	{widget name="Widget_admin" action="lang_tab_panel"}
*/	
?>
<div id="win" class="x-hidden">
  <div class="x-window-header">Управление категориями</div>
  <div id="body">
  </div>
</div>
<script type='text/javascript'>		
	

	var submitPostForm = function(){
		console.log(getSendVariables(new Array(<?php echo $form_reader ?>)));				
		if (editPostForm.form.isValid()) {
            editPostForm.form.submit({
            	params: getSendVariables(new Array(<?php echo $form_reader ?>)),
                waitMsg:'Очікуйте...',
                url:'/admin/news/save',
                failure:function(form, action) {
                    Ext.MessageBox.alert('Помилка', action.result.msg);
                    
                },
                success:function(form, action) {
                	
                	if(action.response.responseText.length > 0){
                		var json = Ext.util.JSON.decode(action.response.responseText);
                		if(json.success){
					        bTabPanel.getComponent(0).enable();
					        bTabPanel.setActiveTab(0);
							bTabPanel.getComponent(1).disable();                    	
		
							itemsStore.load();
                   			return;
                			
                		}else{
							Ext.MessageBox.alert('Помилка', json.msg);				                			
							return;
                			
                		}
                		
                	}
                	Ext.MessageBox.alert('Помилка', 'Помилка збереження');
				                	                	
                }
            });
           
        } else{
            Ext.MessageBox.alert('Помилка', 'Введіть необхідний дані для наступних мов:' + unValidForms);
            
        }
		
	};    

	 var editPostFormReader = new Ext.data.JsonReader({},[<?php echo $form_reader ?>]);
	
	 var editPostForm = new Ext.FormPanel({
    	baseCls:'x-plain',
        method:'POST',
        region:'center',
        border:true,
        labelAlign: 'left',
        autoHeight:true,
        style:'padding:7px',
        labelWidth:150,
        reader: editPostFormReader,
        items:[
	       {
	            xtype:'hidden',
	            name:'n_id'
	        },new Ext.form.DateField({
                name:'n_updated',
                fieldLabel:'Дата/час публікації',                
                format:'Y.m.d',                
                allowBlank:false                
            }),
            new Ext.form.TextField({
            	fieldLabel:'Назва',
            	anchor:'80%',
            	name:'n_title',
            	maxLengthText:'255',
            	allowBlank:false            	
            }),
			new Ext.form.TextField({
            	fieldLabel:'Keywords',
            	anchor:'80%',
            	name:'n_keywords',
            	maxLengthText:'255',
            	allowBlank:true            	
            }),
            new Ext.form.TextField({
            	fieldLabel:'Ссылка на видео',
            	anchor:'80%',
            	name:'video',
            	maxLengthText:'500',
            	allowBlank:true            	
            }),  
            new Ext.form.TextField({
            	fieldLabel:'Источник',
            	anchor:'80%',
            	name:'n_source',
            	maxLengthText:'255',
            	allowBlank:true            	
            }), 
            new Ext.form.Checkbox({
		       	 fieldLabel: 'Важная',
		       	 name:'n_important',
		       	 inputValue:'1',
		       	 checked:false
			}),
            new Ext.form.Checkbox({
				       	 fieldLabel: 'Статус',
				       	 name:'n_status',
				       	 inputValue:'1',
				       	 checked:true
			}),
			
			new Ext.form.ComboBox({
				 store:new Ext.data.JsonStore({
	                    id: 'n_cat_id',
	                    fields: ['id', 'text'],
	                    data : [
	                        <?php if(isset($n_cat)) foreach ($n_cat as $cat): echo "{id: '".$cat->n_cat_id."', text:'".$cat->n_cat_name."'}"; if (next($cat)) echo ','; endforeach;?>
	                    ]
	                }),
						fieldLabel: 'Категория',
						displayField:'text',
						valueField:'id',
						name:'n_cat_id',
						hiddenName:'n_cat_id',
						typeAhead: true,
						mode: 'local',
						forceSelection: true,
						triggerAction: 'all',
						selectOnFocus:false
				}),

				
			
			
			{
	            xtype:'hidden',
	            name:'mp_photo',
	            listeners:{
		            
	            	change:function(field, newVal){
            			
            			var img_link = '/' + newVal;
            			if(newVal.charAt(0) == '/')
            				img_link = newVal;
	           			img_link = img_link + '?t=' + Math.random()*15;
       			
                		Ext.getCmp('logo').body.update('<img width="<?php echo $config['img_width']; ?>"  height="<?php echo $config['img_height']; ?>"  src="' + img_link + '"/>');
	            		field.setValue(newVal);
	            	}
	            	
	            }	            
	        }]         
    });     
    
	var editPostPanel = {
		border:false,
		layout:'border',
		items:[
			{
				region:'north',
				layout:'border',
				border:false,
				height:250,
				items:[{
					region: 'west',
					border: false,
					width: 200,
					baseCls:'x-plain',
					items:[{
						id:'logo_panel',
						style:'padding:5px',
						border:true,
						items:[{
								id:'logo',
								title:'Логотип'
							}],
						bbar:[
							{
								tooltip:'Встановити',
								iconCls:'option',
								handler:function(){
		
									im.type = 'field';
									im.currentObject = editPostForm.form.findField('mp_photo');
									im.CreateWindow();
								    									
								}
								
							},{
								tooltip:'Видалити',
								iconCls:'remove',
								handler:function(){
									editPostForm.form.findField('mp_photo').fireEvent('change', editPostForm.form.findField('mp_photo'), ''); 
									
								}			    								
								
							}
						]
					}]
				},{						
						region:'center',
						border:false,
						baseCls:'x-plain',
						items:editPostForm
						
					}
					
				]
			}, {
				region:'center',
				layout:'fit',
				border:false,
				items:new Ext.TabPanel({
			        deferredRender:false,
			        activeTab:0,
			        tabPosition: 'top',
			        margins:'4 4 4 4',
			        border:false,
			        defaults:{
			            layout:'fit'
			        },
			        baseCls:'x-plain',     	
			        items:[{
			        		title:'Анонс',
			        		layout:'fit',
			        		items:[new Ext.form.TextArea({
			        			id:'n_brieftext'
			        		})]		        		
			        	}, 	{
			        		title:'Текст',
			        		layout:'fit',
							items:[{
					            xtype:'htmleditor',
					            border:false,
					            plugins:[
					            	new Ext.ux.plugins.HtmlEditorImageInsert()					            	
					            ],
					            id: 'n_fulltext'
					        }]			        					        		
		
			        	},{
			        		title:'Description',
			        		layout:'fit',
			        		items:[new Ext.form.TextArea({
			        			id:'n_description'
			        		})]
			        	}
			        
			        ]
			
				})
			}
		
		]
		
		
		
	};   
	
	/*******
	Редагування публікації
	v_id - ідентифікатор публікації
	********/
	var edit_bloger_id = null;
	
	var edit_bloger = function (v_id) {				
		edit_bloger_id = v_id;

		bTabPanel.getComponent(1).enable();
       	setActiveTabCool(bTabPanel, 1);        
        bTabPanel.getComponent(0).disable();
		
	    if(v_id > 0){		    	
		    editPostForm.form.load({url:'/admin/news/edit_news',
		        params:{
		            id:v_id
		        },
		        waitMsg:'Очікуйте...',
		        success:function(response){		        	
		        	loadAfterLoad(new Array(<?php echo $form_reader ?>),editPostFormReader, false);		
		        	var img_link= '/upload/news/m_'+v_id+'.jpg';
		   			Ext.getCmp('logo').body.update('<img width="<?php echo $config['img_width']; ?>" height="<?php echo $config['img_height']; ?>"  src="' + img_link + '"/>');        			        	
	
		        }
		    });
	    }	else{	    	
   			editPostForm.form.reset();
   			loadAfterLoad(new Array(<?php echo $form_reader ?>),editPostFormReader, true);   			
   			editPostForm.form.findField('n_updated').setValue(new Date());   			

	    }
		
	};	
	
	var mainTabPanel = Ext.getCmp('dashboard_mainTabPanelID');
	
	Ext.apply(Ext.form.VTypes, {
	    daterange : function(val, field) {
	        var date = field.parseDate(val);
	
	        if(!date){
	            return;
	        }
	        if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
	            var start = Ext.getCmp(field.startDateField);
	            start.setMaxValue(date);
	            start.validate();
	            this.dateRangeMax = date;
	        } 
	        else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
	            var end = Ext.getCmp(field.endDateField);
	            end.setMinValue(date);
	            end.validate();
	            this.dateRangeMin = date;
	        }
	        return true;
	    }
	});

    
    var itemsStore = new Ext.data.Store({
        autoLoad:true,
        proxy:new Ext.data.HttpProxy({
            url:'/admin/news/list_items'
        }),
        disableCaching:true,
        baseParams:{
            'limit':25
        },
        listeners:Ext.ux.loaderListener,
        reader:new Ext.data.JsonReader({
            root:'items',
            totalProperty:'total',
            id:'n_id'
        },["n_id","n_title","n_cat_id" ,"n_updated", "n_keywords","n_status","n_source","folder",'n_important']),
        remoteSort:true 
    });

    
    var itemsCheckColumn = new Ext.grid.CheckColumn({
        header:'Статус',
        dataIndex:'n_status',
        align: 'center',
        width: 0.15
    });
    var itemImportant = new Ext.grid.CheckColumn({
        header:'Важная',
        dataIndex:'n_important',
        align: 'center',
        width: 0.15
    });    

    var itemsGrid = new Ext.grid.EditorGridPanel({
    	id:'main_posts_grid',
    	region:'center',
        title:'Новини',
        margins:'4 4 4 4',
        clicksToEdit:2,
        border:true,
        ds:itemsStore,
        plugins:[new Ext.ux.grid.Search({
                position:'bottom',
                disableIndexes:['n_updated', 'n_status','n_important'],
                width: 180,
                autoFocus:true
            }),itemsCheckColumn,itemImportant],
        viewConfig: {
            forceFit: true
        },
        split: true,
        enableHdMenu:false,
        selModel:new Ext.grid.RowSelectionModel({singleSelect:false}),
        sm:new Ext.grid.CheckboxSelectionModel(),      
        cm:new Ext.grid.ColumnModel([
            new Ext.grid.CheckboxSelectionModel(),
        {
            header:'ID',
            dataIndex:'n_id',
            sortable: true,
            width: .1,
            align: 'left'},
		{
            header:'Название',
            dataIndex:'n_title',
            sortable: true,            
            align: 'left',
            width: 0.3,
	        editor: new Ext.form.TextField({
	        	maxLengthText:100,
	            allowBlank: false
	        })             
        },{
            header:'Дата создания',
            dataIndex:'n_updated',
            width: .35,
            sortable: true,
            align: 'left'
        },itemsCheckColumn,itemImportant]),
        tbar:[{
            tooltip:'Добавить новость',
            text: 'Добавить',
            iconCls:'add',
            handler:function(){
            	edit_bloger(0);
            	
            }            
        },'-',{
            tooltip:'Редагувати новину',
            iconCls:'option',
            text: 'Редактировать',
            handler:function(){
			    var m = itemsGrid.getSelectionModel().getSelections();
			    if(m.length == 1) {
			    	edit_bloger(m[0].id);
			    	
			    } else {
			        Ext.MessageBox.alert('Інформація', 'Виберіть тільки одну новину');
			    }
            	
            }            
        },'-', {
            tooltip:'Сохранить зміни',
            text: 'Сохранить',
            iconCls:'save',
            handler:function(){
            	itemsSave(itemsStore, '/admin/news/save_grid');
            	
            }

        },'-',{
            tooltip:'Удалить отмеченые новости',
            text: 'Удалить',
            iconCls:'remove',
            handler:function(){
            	itemsRemove(itemsGrid, '/admin/news/remove_news');
            	
            }
        },'-',{
            tooltip:'Управление категориями',
            text: 'Категории',
            iconCls:'option',
            handler:function(){
            	CategoryManage('/admin/news/categogy');
            	
            }
        }],
        bbar:[new Ext.PagingToolbar({
            store:itemsStore,
            pageSize:25,
            displayInfo:true,
            displayMsg:'{0} - {1} из {2}',
            emptyMsg:'Пусто...',
            width:350
        })]
    });

    

    var bTabPanel = new Ext.TabPanel({
    		id:'main_tab_panel',
            border:false,
            activeTab: 0,
            margins:'4 4 4 0',
            tabPosition:'bottom',
            layoutOnTabChange:true,
            monitorResize:true,
            defaults: { autoScroll:true },
            items:[{
                title: 'Новини',
                layout:'border',
                border:false,
                id: 'lstBlogers',
                items: itemsGrid
                
            },{
                title: 'Редагування новин',
                disabled:true,
                layout:'fit',
                baseCls:'x-plain',
                id: 'editBlogers',
                items:[editPostPanel],
                tbar:[{
                    text:'Зберегти',
                    iconCls:'save',
                    handler:function() {
                    	submitPostForm();
                    	
                    }
                }, {
                    text:'Відміна',
                    iconCls:'cancel',
                    handler:function() {                    	
				        bTabPanel.getComponent(0).enable();
				        bTabPanel.setActiveTab(0);
						bTabPanel.getComponent(1).disable();                    	
                    	
                    }
                    

                }]
            }]
    });
    

mainTabPanel.items.each(function(item){mainTabPanel.remove(item);}, mainTabPanel.items);
mainTabPanel.add({
		title: '<?php echo $config['title'] ?>',
		layout:'fit',
		iconCls:'<?php echo $config['icon_cls'] ?>',
		items: [bTabPanel]
	});
    
    mainTabPanel.setActiveTab(0);
    

    
    
</script>