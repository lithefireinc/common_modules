
		<div id="mainBody"></div>
		<script type="text/javascript">
		 Ext.namespace("FILESERV");
		 FILESERV.app = function()
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
	
	 			var Objstore = new Ext.data.Store({
	 						proxy: new Ext.data.HttpProxy({
	 							url: "<?php echo site_url('FILESERV/getFILESERV') ?>",
	 							method: "POST"
	 							}),
	 						reader: new Ext.data.JsonReader({
	 								root: "data",
	 								id: "id",
	 								totalProperty: "totalCount",
	 								fields: [
		{ name: 'SERVCODE'},{ name: 'SERVIDNO'},{ name: 'SERVICE'}
		]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
		
		var colModel = new Ext.grid.ColumnModel([
		{header: "SERVCODE", width: 100, sortable: true, dataIndex: 'SERVCODE'},{header: "SERVIDNO", width: 100, sortable: true, dataIndex: 'SERVIDNO'},{header: "SERVICE", width: 100, sortable: true, dataIndex: 'SERVICE'}
		]);

 			var grid = new Ext.grid.GridPanel({
 				id: 'FILESERVgrid',
 				height: 300,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  colModel,
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: Objstore,
 				        displayInfo: true,
 				        displayMsg: 'Displaying Results {0} - {1} of {2}',
 				        emptyMsg: "No Data Found."
 				    }),
 				tbar: [new Ext.form.ComboBox({
                    fieldLabel: 'Search',
                    hiddenName:'searchby-form',
                    id: 'searchby',
                    typeAhead: true,
                    triggerAction: 'all',
                    emptyText:'Search By...',
                    selectOnFocus:true,
                    store: new Ext.data.SimpleStore({
				         id:0
				        ,fields:
				            [
				             'myId',   //numeric value is the key
				             'myText' //the text value is the value

				            ]


				         , data: [['id', 'ID'], ['sd', 'Short Description'], ['ld', 'Long Description']]

			        }),
				    valueField:'myId',
				    displayField:'myText',
				    mode:'local',
                    width:100,
                    hidden: true

                }), {
					xtype:'tbtext',
					text:'Search:'
				},'   ', new Ext.app.SearchField({ store: Objstore, width:250}),
 					    {
 					     	xtype: 'tbfill'
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: FILESERV.app.Add

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'EDIT',
							icon: '/images/icons/application_edit.png',
 							cls:'x-btn-text-icon',

 					     	handler: FILESERV.app.Edit

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: FILESERV.app.Delete

 					 	}
 	    			 ]
 	    	});

 			FILESERV.app.Grid = grid;
 			FILESERV.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'FILESERV',
 		        width: '100%',
 		        height:'auto',
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [FILESERV.app.Grid],
 		        resizable: false
 	        });

 	        _window.render();


 		},
		
		setForm: function(){

 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url: "<?php echo site_url('FILESERV/addFILESERV') ?>",
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
 		            fieldLabel: 'SERVIDNO*',
 		            name: 'SERVIDNO',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'SERVIDNO'
 		        },
				{
                    xtype:'textfield',
 		            fieldLabel: 'SERVICE*',
 		            name: 'SERVICE',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'SERVICE'
 		        }
 		        		]
 					}
 					]
 		    });

 		    FILESERV.app.Form = form;
 		},
		
 		Add: function(){

 			FILESERV.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New FILESERV',
 		        width: 510,
 		        height: 180,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: FILESERV.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                    icon: '/images/icons/disk.png',  
                    cls:'x-btn-text-icon',
 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(FILESERV.app.Form)){//check if all forms are filled up
 		                FILESERV.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(FILESERV.app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK
 								});
 			                },
 			                waitMsg: 'Saving Data...'
 		                });
 	                }else return;
 	                }
 	            },{
 		            text: 'Cancel',
                    icon: '/images/icons/cancel.png', 
                    cls:'x-btn-text-icon',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		  	_window.show();
 		},
		
		Edit: function(){
 			if(ExtCommon.util.validateSelectionGrid(FILESERV.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = FILESERV.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.SERVCODE;

 			FILESERV.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Classification',
 		        width: 510,
 		        height: 180,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: FILESERV.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                    icon: '/images/icons/disk.png',  
                    cls:'x-btn-text-icon',
 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(FILESERV.app.Form)){//check if all forms are filled up
 		                FILESERV.app.Form.getForm().submit({
 			                url: "<?php echo site_url('FILESERV/updateFILESERV') ?>",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(FILESERV.app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK
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

 		  	FILESERV.app.Form.getForm().load({
 				url: "<?php echo site_url('FILESERV/loadFILESERV') ?>",
 				method: 'POST',
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


			if(ExtCommon.util.validateSelectionGrid(FILESERV.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = FILESERV.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.SERVCODE;
			Ext.Msg.show({
   			title:'Delete Selected',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){
   			Ext.Ajax.request({
                            url: "<?php echo site_url('FILESERV/deleteFILESERV') ?>",
							params:{ id: id},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							FILESERV.app.Grid.getStore().load({params:{start:0, limit: 25}});
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

	 Ext.onReady(FILESERV.app.init, FILESERV.app);
	
	</script>
		