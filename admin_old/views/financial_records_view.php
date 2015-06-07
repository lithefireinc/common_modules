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
 							url: "<?=site_url("student/getFinancialSubjects")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "SUBJCODE"},
 											{ name: "COURSEDESC"},
                                            { name: "UNITS_TTL"},
                                            { name: "FEE_TUI"}
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
                                                  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
 						  						  { header: "Subject Description", width: 300, sortable: true, dataIndex: "COURSEDESC" },
                                                  { header: "Units", width: 100, sortable: true, dataIndex: "UNITS_TTL" },
                                                  { header: "Fee", width: 100, sortable: true, dataIndex: "FEE_TUI" }
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

                })
 					 	
 	    			 ]
 	    	});

 			swp_financial_records.app.Grid = grid;
 			
 			
 			var miscStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getMiscFee")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "MISC"},
 											{ name: "FEE"},
                                            { name: "PAID"},
                                            { name: "BALANCE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var miscGrid = new Ext.grid.GridPanel({
 				id: 'miscgrid',
 				height: 230,
 				anchor: '99%',
 			//	style: "marginLeft: 30",
 				border: true,
 				ds: miscStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  						  { header: "Miscellaneous", width: 300, sortable: true, dataIndex: "MISC" },
                                                //  { header: "Category", width: 100, sortable: true, dataIndex: "DESCRIPTIO" },
                                                  { header: "Total", width: 100, sortable: true, dataIndex: "FEE" },
                                                  { header: "Paid", width: 100, sortable: true, dataIndex: "PAID" },
                                                  { header: "Balance", width: 100, sortable: true, dataIndex: "BALANCE" }
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
 			
 			
 			
 			var labStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getLabFee")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "LABORATORY"},
 											{ name: "CATEGORY"},
                                            { name: "FEE"},
                                            { name: "PAID"},
                                            { name: "BALANCE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var labGrid = new Ext.grid.GridPanel({
 				id: 'labgrid',
 				height: 200,
 				anchor: '99%',
 			//	style: "marginTop: 10",
 				border: true,
 				ds: labStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  						  { header: "Laboratory", width: 150, sortable: true, dataIndex: "LABORATORY" },
                                                 // { header: "Category", width: 100, sortable: true, dataIndex: "CATEGORY" },
                                                  { header: "Total", width: 100, sortable: true, dataIndex: "FEE" },
                                                  { header: "Paid", width: 100, sortable: true, dataIndex: "PAID" },
                                                  { header: "Balance", width: 100, sortable: true, dataIndex: "BALANCE" }
 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: labStore,
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

 			swp_financial_records.app.labGrid = labGrid;
 			
 			
 			var otherFeeStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getOtherFee")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "OTHER"},
 											{ name: "FEE"},
                                            { name: "PAID"},
                                            { name: "BALANCE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var otherFeeGrid = new Ext.grid.GridPanel({
 				id: 'otherFeegrid',
 				height: 200,
 				anchor: '99%',
 				//style: "margin: 10 0 0 15",
 				border: true,
 				ds: otherFeeStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  						  { header: "Other Fees", width: 150, sortable: true, dataIndex: "OTHER" },
                                                //  { header: "Category", width: 100, sortable: true, dataIndex: "DESCRIPTIO" },
                                                  { header: "Total", width: 100, sortable: true, dataIndex: "FEE" },
                                                  { header: "Paid", width: 100, sortable: true, dataIndex: "PAID" },
                                                  { header: "Balance", width: 100, sortable: true, dataIndex: "BALANCE" }
 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: otherFeeStore,
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

 			swp_financial_records.app.otherFeeGrid = otherFeeGrid;
 			
 			
 			
 			var summaryStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getFeeSummary")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "TOTAL"},
 											{ name: "TOTALPAID"},
                                            { name: "DESCRIPTION"},
                                            { name: "BALANCE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var summaryGrid = new Ext.grid.GridPanel({
 				id: 'summarygrid',
 				height: 200,
 				anchor: '99%',
 				//style: "margin: 10 0 0 15",
 				border: true,
 				ds: summaryStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  						  { header: "Summary", width: 150, sortable: true, dataIndex: "DESCRIPTION" },
                                                  { header: "Total", width: 100, sortable: true, dataIndex: "TOTAL" },
                                                  { header: "Paid", width: 100, sortable: true, dataIndex: "TOTALPAID" },
                                                  { header: "Balance", width: 100, sortable: true, dataIndex: "BALANCE" }
 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: summaryStore,
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

                }), '->',
                		{
 					     	xtype: 'tbbutton',
 					     	text: 'VIEW RECEIPTS',
							icon: '/images/icons/page_white_text.png',
 							cls:'x-btn-text-icon',

 					     	handler: swp_financial_records.app.viewReceipt

 					 	}
 					 	
 	    			 ]
 	    	});

 			swp_financial_records.app.summaryGrid = summaryGrid;
 			
 			
 			var form = new Ext.form.FormPanel({
 		        labelWidth: 100,
 		        url:"<?=site_url("filereference/addRoom")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
				layout: 'form',
 		        items: [
 		        { xtype: 'fieldset', 
 		       items: [
 		        {
							layout: 'column',
							items: [
							{
								columnWidth: .33,
								layout: 'form',
								items: [ swp_financial_records.app.semesterCombo()]
							},
							{
								columnWidth: .33,
								layout: 'form',
								items: swp_financial_records.app.studentCombo()
							},
							
							{
								columnWidth: .33,
								layout: 'form',
								items: []
							}
							]
						},
						{
							layout: 'column',
							items: [
							
							{
								columnWidth: .33,
								layout: 'form',
								items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'Course',
                                                  name: 'COURSE',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'COURSE'

                                                  }]
							},
							{
								columnWidth: .33,
								layout: 'form',
								items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'Year',
                                                  name: 'YEAR',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'YEAR'

                                                  }]
							},
							{
								columnWidth: .33,
								layout: 'form',
								items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'Section',
                                                  name: 'SECTION',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'SECTION'

                                                  }]
							}
							]
						}]},
                     new Ext.TabPanel({

		        width:'auto',
		        activeTab: 0,
		        height: 385,
               // autoScroll: true,
                deferredRender: false,
		        //defaults:{autoHeight: true},
		        items:[
			        {
				        title: 'Subjects', 
				        height: 'auto',
				        frame: true, 
				        layout: 'fit', 
				        autoScroll: true, 
			        	items:[
			        		swp_financial_records.app.Grid
			        	]
			        },
			        {
				        title: 'Laboratory', 
				        height: 'auto',
				        frame: true, 
				        layout: 'fit', 
				        autoScroll: true, 
			        	items:[
			        		swp_financial_records.app.labGrid
			        	]
			        },
			        {
				        title: 'Miscellaneous', 
				        height: 'auto',
				        frame: true, 
				        layout: 'fit', 
				        autoScroll: true, 
			        	items:[
			        		swp_financial_records.app.miscGrid
			        	]
			        },
			        {
				        title: 'Other Fees', 
				        height: 'auto',
				        frame: true, 
				        layout: 'fit', 
				        autoScroll: true, 
			        	items:[
			        		swp_financial_records.app.otherFeeGrid
			        	]
			        },
			        {
				        title: 'Summary', 
				        height: 'auto',
				        frame: true, 
				        layout: 'fit', 
				        autoScroll: true, 
			        	items:[
			        		swp_financial_records.app.summaryGrid
			        	]
			        }
			        ]
			        	
			      })
                      

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
                                 swp_financial_records.app.Grid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
							}

						});
			//swp_financial_records.app.Grid.getStore().setBaseParam("SEMEIDNO", Ext.get("SEMEIDNO").dom.value);
		/*	swp_financial_records.app.Grid.getStore().load();
			swp_financial_records.app.miscGrid.getStore().load({params:{start: 0, limit: 25}});
			swp_financial_records.app.labGrid.getStore().load({params:{start: 0, limit: 25}});			
			swp_financial_records.app.otherFeeGrid.getStore().load({params:{start: 0, limit: 25}});			
			swp_financial_records.app.summaryGrid.getStore().load({params:{start: 0, limit: 25}});*/
 	        
 	       

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


		},
		semesterCombo: function(){

		return {
			xtype:'combo',
			id:'SEMESTER',
			hiddenName: 'SEMEIDNO',
            hiddenId: 'SEMEIDNO',
			name: 'SEMESTER',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("filereference/getFilteredSemesterCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function(qe)
					{

                                    delete qe.combo.lastQuery;
           
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
            swp_financial_records.app.Grid.getStore().setBaseParam("SEMEIDNO", record.get('id'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a semester'});
			swp_financial_records.app.Grid.getStore().setBaseParam("SEMEIDNO", this.value);

			},
			keypress: {buffer: 100, fn: function() {
			Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Semester*'

			}
	},
		studentCombo: function(){

		return {
			xtype:'combo',
			id:'STUDENT',
			hiddenName: 'STUDCODE',
            hiddenId: 'STUDCODE',
			name: 'STUDENT',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
                       // disabled: true,
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}, {name: 'STUDIDNO'}, {name: 'SECTION'}, {name: 'COURSE'}, {name: 'YEAR'}],
			url: "<?php echo site_url("filereference/getStudentCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			beforequery: function(qe){
				delete qe.combo.lastQuery;
			},	
			select: function (combo, record, index){
			
                    
            this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			Ext.getCmp("SECTION").setValue(record.get('SECTION'));
			Ext.getCmp("COURSE").setValue(record.get('COURSE'));
			Ext.getCmp("YEAR").setValue(record.get('YEAR'));
			swp_financial_records.app.Grid.getStore().setBaseParam("STUDIDNO", record.get("id"));
			swp_financial_records.app.miscGrid.getStore().setBaseParam("STUDIDNO", record.get("id"));
			swp_financial_records.app.labGrid.getStore().setBaseParam("STUDIDNO", record.get("id"));
			swp_financial_records.app.otherFeeGrid.getStore().setBaseParam("STUDIDNO", record.get("id"));
			swp_financial_records.app.summaryGrid.getStore().setBaseParam("STUDIDNO", record.get("id"));
			swp_financial_records.app.Grid.getStore().load();
			swp_financial_records.app.miscGrid.getStore().load({params:{start: 0, limit: 25}});
			swp_financial_records.app.labGrid.getStore().load({params:{start: 0, limit: 25}});			
			swp_financial_records.app.otherFeeGrid.getStore().load({params:{start: 0, limit: 25}});			
			swp_financial_records.app.summaryGrid.getStore().load({params:{start: 0, limit: 25}});
			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a student'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Student*'

			}
	},
 		viewReceipt: function(){
 			if(!Ext.getCmp("STUDENT").validate()){
 				return;
 			}
 			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getReceipts")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "DATE"},
 											{ name: "ORNO"},
                                            { name: "PARTICULAR"},
                                            { name: "TOTAL"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, SEMEIDNO: Ext.get('SEMEIDNO').dom.value, STUDIDNO: Ext.get('STUDCODE').dom.value}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'swp_financial_recordsgrid',
 				height: 230,
 				anchor: '99%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Date", width: 100, sortable: true, dataIndex: "DATE" },
 						  						  { header: "OR Number", width: 100, sortable: true, dataIndex: "ORNO" },
                                                  { header: "Particular", width: 300, sortable: true, dataIndex: "PARTICULAR" },
                                                  { header: "Total", width: 100, sortable: true, dataIndex: "TOTAL" }
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

                })
 					 	
 	    			 ]
 	    	});

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'Receipts',
 		        width: 650,
 		        height:400,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: [grid],
 		        buttons: [{
 		            text: 'Close',
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		  	_window.show();
 		  	grid.getStore().load();
 		}
 	}

 }();

 Ext.onReady(swp_financial_records.app.init, swp_financial_records.app);

</script>
<div id="mainBody"></div>
