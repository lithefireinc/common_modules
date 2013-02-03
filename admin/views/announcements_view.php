<script type="text/javascript">
 Ext.namespace("announcements");
 announcements.app = function()
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
 							url: "<?=site_url("admin/getAnnouncements")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
 											{ name: "TITLE"},
 											{ name: "BODY"},
 											{ name: "DCREATED"},
 											{ name: "TCREATED"},
 											{ name: "DMODIFIED"},
 											{ name: "TMODIFIED"},
 											{ name: "AUTHOR"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'announcementsgrid',
 				height: 300,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                            { header: "ID", width: 75, sortable: true, dataIndex: "id" },
 						  	{ header: "Title", width: 100, sortable: true, dataIndex: "TITLE" },
                            { header: "Body", width: 250, sortable: true, dataIndex: "BODY" },
                            { header: "Date Created", width: 100, sortable: true, dataIndex: "DCREATED" },
 						  	{ header: "Time Created", width: 100, sortable: true, dataIndex: "TCREATED" },
 						  	{ header: "Date Modified", width: 100, sortable: true, dataIndex: "DMODIFIED" },
                            { header: "Time Modified", width: 100, sortable: true, dataIndex: "TMODIFIED" },
                            { header: "Author", width: 150, sortable: true, dataIndex: "AUTHOR" }
 						]
 				),
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
					//store: Objstore,
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

 					     	handler: announcements.app.Add

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'EDIT',
							icon: '/images/icons/application_edit.png',
 							cls:'x-btn-text-icon',

 					     	handler: announcements.app.Edit

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: announcements.app.Delete

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'ASSIGN USER TYPE',
							icon: '/images/icons/application_key.png',
 							cls:'x-btn-text-icon',

 					     	handler: announcements.app.AssignUserType

 					 	}
 	    			 ]
 	    	});

 			announcements.app.Grid = grid;
 			announcements.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Country',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [announcements.app.Grid],
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
	    	/*var store = new Ext.data.Store({ 
				proxy: new Ext.data.HttpProxy({ 
					url: "",
					method: "POST"
				}),																
				reader: new Ext.data.JsonReader({
					root: "data",
					id: "id123",	
					totalProperty: "totalCount",	
					fields: [	
						{ name: "maintenance_details_id"}
					]		
				}),
				remoteSort: true,							 							
				baseParams: {start: 0, limit: 25}							
			});
	    	
		    var grid = new Ext.grid.GridPanel({										
				id: 'announcementsgrid',	
				height: 170,
				width: 'auto',
				border: true,         		        		
				store: store,
				cm:  new Ext.grid.ColumnModel([								  
					{ header: "Details", width: 160, sortable: true }
				]),
				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),		        
		    	loadMask: true,
		    	bbar: 			        	
		    		new Ext.PagingToolbar({
		        		autoShow: true,
				        pageSize: 25,
				        store: store,
				        displayInfo: true,						        
				        displayMsg: 'Displaying Results {0} - {1} of {2}',
				        emptyMsg: "No Data Found."					        
				    }),			        	
				tbar: [{
					xtype: 'tbfill'
					},{
						xtype: 'tbbutton',
					   	text: 'ADD',	
					   	icon: '/images/icons/application_add.png',
 						cls:'x-btn-text-icon',															
					   	handler: announcements.app.selectUserType     
					},'-',{
					   	xtype: 'tbbutton',
					   	text: 'DELETE',				
					   	icon: '/images/icons/application_delete.png',
 						cls:'x-btn-text-icon',							
					   	handler: announcements.app.aDelete
				}]
			}); */
    	
			var form = new Ext.form.FormPanel({
		        labelWidth: 150,
		        url:"<?=site_url("admin/addAnnouncements")?>",
		        method: 'POST',
		        defaultType: 'textfield',
		        frame: true,
		        items: [
			        {
						xtype:'fieldset',
						title:'Fields w/ Asterisks are required.',
						width:'auto',
						height:'auto',
						items:[
		 					{
								xtype:'textfield',
		 		            	fieldLabel: 'Title*',
		                        autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "47"},
		 		            	name: 'TITLE',
				 		        allowBlank:false,
				 		        anchor:'93%',  // anchor width by percentage
				 		        id: 'TITLE'
		 		        	},{
		                        xtype:'textfield',
			            		fieldLabel: 'Body*',
		                        autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "47"},
			            		name: 'BODY',
			 		            allowBlank:false,
			 		            anchor:'93%',  // anchor width by percentage
			 		            id: 'BODY'
			        		}
			        	]
					}
		        ]
		    });

		    announcements.app.Form = form;
			//announcements.app.Grid2 = grid;
			//grid.getStore().load({params:{start: 0, limit: 25}});
		},
			
		Add: function(){
	
			announcements.app.setForm();
	
		  	var _window;
	
		    _window = new Ext.Window({
		        title: 'New Announcement',
		        width: 510,
		        height: 180,
		        layout: 'fit',
		        plain:true,
		        modal: true,
		        bodyStyle:'padding:5px;',
		        buttonAlign:'center',
		        items: announcements.app.Form,
		        buttons: [{
		         	text: 'Save',
	                            icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',
	
	                handler: function () {
			            if(ExtCommon.util.validateFormFields(announcements.app.Form)){//check if all forms are filled up
	
		                announcements.app.Form.getForm().submit({
			                success: function(f,action){
	             		    	Ext.MessageBox.alert('Status', action.result.data);
	              		    	 Ext.Msg.show({
								     title: 'Status',
								     msg: action.result.data,
								     buttons: Ext.Msg.OK,
								     icon: 'icon'
								 });
				                ExtCommon.util.refreshGrid(announcements.app.Grid.getId());
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
	                        icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',
	
		            handler: function(){
			            _window.destroy();
		            }
		        }]
		    });
		  	_window.show();
		},
	 		
		Edit: function(){
	
	
			if(ExtCommon.util.validateSelectionGrid(announcements.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = announcements.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.id;
	
			announcements.app.setForm();
		    _window = new Ext.Window({
		        title: 'Update Announcement',
		        width: 510,
		        height:170,
		        layout: 'fit',
		        plain:true,
		        modal: true,
		        bodyStyle:'padding:5px;',
		        buttonAlign:'center',
		        items: announcements.app.Form,
		        buttons: [{
		         	text: 'Save',
	                            icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',
	
		            handler: function () {
			            if(ExtCommon.util.validateFormFields(announcements.app.Form)){//check if all forms are filled up
		                announcements.app.Form.getForm().submit({
			                url: "<?=site_url("admin/updateAnnouncements")?>",
			                params: {id: id},
			                method: 'POST',
			                success: function(f,action){
	             		    	Ext.MessageBox.alert('Status', action.result.data);
				                ExtCommon.util.refreshGrid(announcements.app.Grid.getId());
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
	
		  	announcements.app.Form.getForm().load({
				url: "<?=site_url("admin/loadAnnouncements")?>",
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
	
	
			if(ExtCommon.util.validateSelectionGrid(announcements.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = announcements.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.id;
			Ext.Msg.show({
			title:'Delete',
			msg: 'Are you sure you want to delete this record?',
			buttons: Ext.Msg.OKCANCEL,
			fn: function(btn, text){
			if (btn == 'ok'){
	
			Ext.Ajax.request({
	                        url: "<?=  site_url("admin/deleteAnnouncements")?>",
							params:{ id: id},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
	            		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							Ext.Msg.show({
								title: 'Status',
								msg: "Record deleted successfully",
								icon: Ext.Msg.INFO,
								buttons: Ext.Msg.OK
							});
							announcements.app.Grid.getStore().load({params:{start:0, limit: 25}});
	
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
	
		},
		
		AssignUserType: function(){
			if(ExtCommon.util.validateSelectionGrid(announcements.app.Grid.getId())){//check if user has selected an item in the grid
				var sm = announcements.app.Grid.getSelectionModel();
			 	var id = sm.getSelected().data.id;

				var moduleStore = new Ext.data.Store({
					proxy: new Ext.data.HttpProxy({
						url: "<?php echo site_url("admin/getFilteredUserType"); ?>",
						method: "POST"
					}),
					reader: new Ext.data.JsonReader({
						root: "data",
						id: "id",
						totalProperty: "totalCount",
						fields: [
							{ name: "id", mapping: "id"},
							{ name: "code", mapping: "code"},
							{name: "description", mapping: "description"}
						]
					}),
					remoteSort: true,
					baseParams: {start: 0, limit: 25, id: id}
				});

				var moduleGrid = new Ext.grid.GridPanel({
		 			id: 'moduleGrid',
		 			height: 300,
		 			width: 450,
		 			border: true,
		 			ds: moduleStore,
		 			cm: new Ext.grid.ColumnModel([
		 				{ header: "ID", dataIndex: "id", width: 50, sortable: true},
		 				{ header: "Code", width: 200, sortable: true, dataIndex: "code" },
		 				{ header: "Description", width: 200, sortable: true, dataIndex: "description" }
		 			]),
		 			sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
		 	        loadMask: true,
		 	        bbar:
		 	        	new Ext.PagingToolbar({
		 		        	autoShow: true,
		 				    pageSize: 25,
		 				    store: moduleStore,
		 				    displayInfo: true,
		 				    displayMsg: 'Displaying Results {0} - {1} of {2}',
		 				    emptyMsg: "No Data Found."
		 				}),
			 			tbar: [
			 				{
								xtype:'tbtext',
								text:'Search:'
							},'   ', 
								new Ext.app.SearchField({ store: moduleStore, width:150}),
			 				{
			 					xtype: 'tbfill'
			 				},{
								xtype: 'tbbutton',
								icon: '/images/icons/application_add.png',
								cls:'x-btn-text-icon',
								text: 'ADD',
								handler: announcements.app.SelectUserType
	
							}, '-',{
			 					xtype: 'tbbutton',
			 					text: 'DELETE',
								icon: '/images/icons/application_delete.png',
			 					cls:'x-btn-text-icon',
			 					handler: announcements.app.DeleteUserType
							}
			 	    	]
		 	    });

		 	    announcements.app.moduleGrid = moduleGrid;
		 	    announcements.app.moduleGrid.getStore().load({params:{start: 0, limit: 25}});

				var moduleWindow = new Ext.Window({
			 		title: 'Filtered User Type',
			 		width: 500,
			 		height:310,
			 		layout: 'fit',
			 		plain:true,
			 		modal: true,
			 		bodyStyle:'padding:5px;',
			 		buttonAlign:'center',
			 		items: announcements.app.moduleGrid
			 	}).show();
			}
		},
		
		DeleteUserType: function(){
			if(ExtCommon.util.validateSelectionGrid(announcements.app.moduleGrid.getId())){//check if user has selected an item in the grid
				var sm = announcements.app.moduleGrid.getSelectionModel();
				var id = sm.getSelected().data.id;
				Ext.Msg.show({
					title:'Delete',
					msg: 'Are you sure you want to delete this record?',
					buttons: Ext.Msg.OKCANCEL,
					fn: function(btn, text){
				   		if (btn == 'ok'){
				   			Ext.Ajax.request({
								url: "<?=site_url("admin/deleteUserType")?>",
								params:{ id: id},
								method: "POST",
								timeout:300000000,
							    success: function(responseObj){
				                	var response = Ext.decode(responseObj.responseText);
									if(response.success == true){
										announcements.app.moduleGrid.getStore().load({params:{start:0, limit: 25}});
										return;
									}else if(response.success == false){
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
		},
		
		SelectUserType: function(){
			var anno_sm = announcements.app.Grid.getSelectionModel();
	        var anno_id = anno_sm.getSelected().data.id;
			
	        var store = new Ext.data.Store({
	        	proxy: new Ext.data.HttpProxy({ 
					url: "<?=site_url("admin/getUserType")?>",
					method: "POST"
				}),
				reader: new Ext.data.JsonReader({						
					root: "data",
					//id: "id123",	
					totalProperty: "totalCount",	
					fields: [	
						{ name: "id", mapping: "id" },
						{ name: "code", mapping: "code" },
						{ name: "description", mapping: "description" }
					]
				}),
				remoteSort: true,
				baseParams: {id: anno_id}							
			});
	
	        var sm1 = new Ext.grid.CheckboxSelectionModel({checkOnly: true,dataIndex: 'id'});
	
			var gridMrfItemList = new Ext.grid.GridPanel({
				title: "Select User Type",
				id: 'mrfItemList',
				height: 300,
				width: 'auto',
				stripeRows: true,
				border: true,
				layout: "absolute",
				ds: store,
				cm:  new Ext.grid.ColumnModel([
					sm1,
					{ header: "ID", width: 50, sortable: true, locked:true, dataIndex: "id" },
					{ header: "Code", width: 150, sortable: true, locked:true, dataIndex: "code" },
					{ header: "Description", width: 150, sortable: true, locked:true, dataIndex: "description" }
				]),
				selModel: sm1,
				loadMask: true,
				tbar: [ 'Search: ', ' ', new Ext.app.SearchField({ store: store, width:150}) ],
				bbar: new Ext.PagingToolbar({
					autoShow: true,
					pageSize: 10,
					store: store,
					displayInfo: true,
					displayMsg: 'Displaying Records {0} - {1} of {2}',
					emptyMsg: "No Data Found."
				})
			});
	
			var fpanel = new Ext.form.FormPanel({
				id: "mrfItemListForm",
				method: "POST",
				height: 300,
				width: 520,
				border: false,
				items: [gridMrfItemList]
			});
	
			var addItemListWin = new Ext.Window({
				title: 'Add User Type',
				width: 550,
				height: 380,
				modal: true,
				autoScroll: true,
				buttonAlign:'right',
				bodyStyle:'padding:5px;',
				resizable: false,
				items: [ fpanel ],
				buttons: [{
					text: "Save",
					icon: '/images/icons/disk.png',
					cls:'x-btn-text-icon',
					handler: function(){
						if(!ExtCommon.util.validateSelectionGrid(gridMrfItemList.getId()))
						return;
						
						var selectedItemsJson = Ext.getCmp("mrfItemList").getSelectionModel().getSelections();
						
						var objectJson = { data: new Array() };
						
						for (var key in selectedItemsJson){
							tmpJson = Ext.util.JSON.encode(selectedItemsJson[key].data);
							if(tmpJson != null && typeof(tmpJson) != "undefined" && tmpJson != "null"){
								objectJson.data.push(selectedItemsJson[key].data.id);
							}
						}
	
			    		Ext.getCmp("mrfItemListForm").getForm().submit({
						 	url:"<?php echo site_url("admin/insertFilteredUserType"); ?>",
						 	method: 'POST',
						 	params: { selected_items: Ext.util.JSON.encode(objectJson), anno_id: anno_id },
						 	waitMsg:'Loading...',
							success: function(form, action){
							    try{
							    	Ext.MessageBox.alert('Status', action.result.msg);
							    	Ext.getCmp('grandtotal').setValue(action.result.grandtotal);
							    }catch(e){
							    	Ext.MessageBox.alert('Status', "Successfully saved.");
						    	}
								announcements.app.moduleGrid.getStore().reload({params:{start:0, limit: 10}});
				                	addItemListWin.destroy();
							},

							failure: function(form, action){
								Ext.Msg.show({title: 'Error Alert',	msg: action.result.msg, icon: Ext.Msg.ERROR,buttons: Ext.Msg.OK});
							}
						});
					}
				},{ 
					text: "Close",
					icon: '/images/icons/cancel.png',
					cls:'x-btn-text-icon', 
					handler: function(){
						addItemListWin.destroy();
					}
				}],
				listeners:{
					show: function(){
						store.load({params:{start:0, limit:10}});
					}
				}
			});
	
			addItemListWin.show();
		}//end of functions
 	}

 }();

 Ext.onReady(announcements.app.init, announcements.app);

</script>
<div id="mainBody"></div>