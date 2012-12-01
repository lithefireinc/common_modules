<script type="text/javascript">
 Ext.namespace("swp_financial_records");
 swp_financial_records.app = function()
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
 							url: "<?=site_url("filereference/getRoom")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "ROOMIDNO"},
 											{ name: "ROOM"},
                                            { name: "DESCRIPTIO"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'swp_financial_recordsgrid',
 				height: 230,
 				anchor: '99%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Subj Code", width: 100, sortable: true, dataIndex: "ROOMIDNO" },
 						  						  { header: "Subj Description", width: 300, sortable: true, dataIndex: "ROOM" },
                                                  { header: "Units", width: 100, sortable: true, dataIndex: "DESCRIPTIO" },
                                                  { header: "Fee", width: 100, sortable: true, dataIndex: "DESCRIPTIO" },
                                                  { header: "Paid", width: 100, sortable: true, dataIndex: "DESCRIPTIO" }
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

                }), 'Semester: ',ExtCommon.util.createCombo('SEMESTER', 'SEMEIDNO', '30%', '<?php echo site_url('filereference/getFilteredSemesterCombo')?>', 'Semester*', false, false)
 					 	
 	    			 ]
 	    	});

 			swp_financial_records.app.Grid = grid;
 			swp_financial_records.app.Grid.getStore().load({params:{start: 0, limit: 25}});
 			
 			var miscStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("filereference/getRoom")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "ROOMIDNO"},
 											{ name: "ROOM"},
                                            { name: "DESCRIPTIO"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var miscGrid = new Ext.grid.GridPanel({
 				id: 'miscgrid',
 				height: 230,
 				anchor: '99%',
 				style: "marginLeft: 30",
 				border: true,
 				ds: miscStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  						  { header: "Miscellaneous", width: 300, sortable: true, dataIndex: "ROOM" },
                                                  { header: "Category", width: 100, sortable: true, dataIndex: "DESCRIPTIO" },
                                                  { header: "Total", width: 100, sortable: true, dataIndex: "DESCRIPTIO" },
                                                  { header: "Paid", width: 100, sortable: true, dataIndex: "DESCRIPTIO" }
 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: miscStore,
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

                })
 					 	
 	    			 ]
 	    	});

 			swp_financial_records.app.miscGrid = miscGrid;
 			swp_financial_records.app.miscGrid.getStore().load({params:{start: 0, limit: 25}});
 			
 			var form = new Ext.form.FormPanel({
 		        labelWidth: 100,
 		        url:"<?=site_url("filereference/addRoom")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ 
                     {
                     	xtype: 'fieldset',
                     	width: 'auto',
                     	items:[
                     		{
                     			layout: 'column',
                     			width: 'auto',
                     			items: [
                     				{
                     					columnWidth: .5,
                     					layout: 'form',
                     					items: swp_financial_records.app.Grid
                     				},
                     				{
                     					columnWidth: .5,
                     					layout: 'form',
                     					items: swp_financial_records.app.miscGrid
                     				}
                     			]
                     		}
                     	]
                     }
                      

 		        ]
 		    });

 			var _window = new Ext.Panel({
 		        title: 'My Financial Records',
 		        width: '100%',
 		        height:520,
 		        frame: true,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [form],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });
 	        
 	        form.form.load({
							url:"<?php echo site_url("filereference/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
								 Ext.getCmp("SEMESTER").setValue(action.result.data.semester);
                                 Ext.get("SEMEIDNO").dom.value = action.result.data.SEMEIDNO;
							}

						});

 	        _window.render();


 		},
 			setForm: function(){
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?=site_url("filereference/addRoom")?>",
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
 		            fieldLabel: 'Room Name*',
                            autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "47"},
 		            name: 'ROOM',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'ROOM'
 		        },
                        {
                            xtype:'textarea',
 		            fieldLabel: 'Description*',
                            maxLength: 47,
 		            name: 'DESCRIPTIO',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'DESCRIPTIO'
 		        }

 		        ]
 					}
 		        ]
 		    });

 		    swp_financial_records.app.Form = form;
 		},
 		Add: function(){

 			swp_financial_records.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New Room',
 		        width: 510,
 		        height:230,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: swp_financial_records.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(swp_financial_records.app.Form)){//check if all forms are filled up

 		                swp_financial_records.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(swp_financial_records.app.Grid.getId());
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


 			if(ExtCommon.util.validateSelectionGrid(swp_financial_records.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = swp_financial_records.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.ROOMIDNO;

 			swp_financial_records.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Room',
 		        width: 510,
 		        height:230,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: swp_financial_records.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(swp_financial_records.app.Form)){//check if all forms are filled up
 		                swp_financial_records.app.Form.getForm().submit({
 			                url: "<?=site_url("filereference/updateRoom")?>",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(swp_financial_records.app.Grid.getId());
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

 		  	swp_financial_records.app.Form.getForm().load({
 				url: "<?=site_url("filereference/loadRoom")?>",
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


			if(ExtCommon.util.validateSelectionGrid(swp_financial_records.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = swp_financial_records.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.ROOMIDNO;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("filereference/deleteRoom")?>",
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
							swp_financial_records.app.Grid.getStore().load({params:{start:0, limit: 25}});

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

 Ext.onReady(swp_financial_records.app.init, swp_financial_records.app);

</script>
<div id="mainBody"></div>
