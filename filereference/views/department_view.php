<script type="text/javascript">
 Ext.namespace("hrisv2_department");
 hrisv2_department.app = function()
 {
 	return{
 		init: function()
 		{
 			ExtCommon.util.init();
 			ExtCommon.util.quickTips();
 			this.getGrid();
 		},
 		getGrid: function()
 		{
 			ExtCommon.util.renderSearchField('searchby');
            var fields = [{ name: "dept_idno"},{ name: "dept_type"}];
            var get_url = "<?php echo site_url('filereference/Department/getIndex') ?>";
            var columns = [{ header: "Id", width: 75, sortable: true, dataIndex: "dept_idno" },
                { header: "Department", width: 300, sortable: true, dataIndex: "dept_type" }];

            var grid = new Application.filereferencegrid({
                id: "subdepartment_grid",
                url: get_url,
                fields: fields,
                columns: columns,
                addFn: hrisv2_department.app.Add,
                editFn: hrisv2_department.app.Edit,
                deleteFn: hrisv2_department.app.Delete
            });
 			hrisv2_department.app.Grid = grid;
 			hrisv2_department.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Department',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [hrisv2_department.app.Grid],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });

 	        _window.render();


 		},
 			setForm: function(){
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?php echo site_url("filereference/Department/store")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[
                        {

                            xtype:'textfield',
 		            fieldLabel: 'Department*',
                            autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "47"},
 		            name: 'dept_type',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'dept_type'
 		        }

 		        ]
 					}
 		        ]
 		    });

 		    hrisv2_department.app.Form = form;
 		},
 		Add: function(){

 			hrisv2_department.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New Department',
 		        width: 510,
 		        height:170,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: hrisv2_department.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(hrisv2_department.app.Form)){//check if all forms are filled up

 		                hrisv2_department.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: Ext.Msg.INFO,
                                     width: '100%'
  								 });
 				                ExtCommon.util.refreshGrid(hrisv2_department.app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
                                    width: '100%',
 									buttons: Ext.Msg.OK
 								});
 			                },
 			                waitMsg: 'Saving Data...'
 		                });
 	                }else return;
 	                }
 	            },{
 		            text: 'Cancel',
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		  	_window.show();
 		},
 		Edit: function(){


 			if(ExtCommon.util.validateSelectionGrid(hrisv2_department.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = hrisv2_department.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.dept_idno;

 			hrisv2_department.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Department',
 		        width: 510,
 		        height:170,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: hrisv2_department.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(hrisv2_department.app.Form)){//check if all forms are filled up
 		                hrisv2_department.app.Form.getForm().submit({
 			                url: "<?php echo site_url("filereference/Department/update")?>",
 			                params: {dept_idno: id},
 			                method: 'POST',
 			                success: function(f,action){
                                Ext.Msg.show({
                                    title: 'Status',
                                    msg: action.result.data,
                                    icon: Ext.Msg.INFO,
                                    width: '100%',
                                    buttons: Ext.Msg.OK
                                });
 				                ExtCommon.util.refreshGrid(hrisv2_department.app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK,
                                    width: '100%'
 								});
 			                },
 			                waitMsg: 'Updating Data...'
 		                });
 	                }else return;
 		            }
 		        },{
 		            text: 'Cancel',
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

 		  	hrisv2_department.app.Form.getForm().load({
 				url: "<?php echo site_url("filereference/Department/show")?>",
 				method: 'GET',
 				params: {id: id},
 				timeout: 300000,
 				waitMsg:'Loading...',
 				success: function(form, action){
                                    _window.show();
 				},
 				failure: function(form, action) {
         					Ext.Msg.show({
 									title: 'Error Alert',
 									msg: "A connection to the server could not be established",
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK,
 									fn: function(){ _window.destroy(); }
 								});
     			}
 			});
 			}else return;
 		},
		Delete: function(){
			if(ExtCommon.util.validateSelectionGrid(hrisv2_department.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = hrisv2_department.app.Grid.getSelectionModel().getSelections();
                var objectJson = { data: new Array() };

                for (var key in sm){
                    var tmpJson = Ext.util.JSON.encode(sm[key].data);
                    if(tmpJson != null && typeof(tmpJson) != "undefined" && tmpJson != "null"){
                        objectJson.data.push(sm[key].data.dept_idno);
                    }

                }
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?php echo   site_url("filereference/Department/destroy")?>",
							params:{ id: Ext.util.JSON.encode(objectJson)},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							hrisv2_department.app.Grid.getStore().load({params:{start:0, limit: 25}});
							return;

						}
						else if(response.success == false)
						{
							Ext.Msg.show({
								title: 'Error!',
								msg: "There was an error encountered in deleting the record. Please try again",
								icon: Ext.Msg.ERROR,
								buttons: Ext.Msg.OK
							});

							return;
						}
							},
			                failure: function(f,a){
								Ext.Msg.show({
									title: 'Error Alert',
									msg: "There was an error encountered in deleting the record. Please try again",
									icon: Ext.Msg.ERROR,
									buttons: Ext.Msg.OK
								});
			                },
			                waitMsg: 'Deleting Data...'
						});
   			}
   			},

   			icon: Ext.MessageBox.QUESTION
			});

	                }else return;


		}
 	}

 }();

 Ext.onReady(hrisv2_department.app.init, hrisv2_department.app);

</script>
<div id="mainBody"></div>
