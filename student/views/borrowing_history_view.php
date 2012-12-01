<script type="text/javascript">
 Ext.namespace("student_borrowing_history");
 student_borrowing_history.app = function()
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
 							url: "<?=site_url("book/getStudentBorrowingHistory")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [	
 											{ name: "ACCESSNO"},
 											{ name: "TITLE"},
 											{ name: "STUDIDNO"},
 											{ name: "NAME"},
 											{ name: "D_BORROWED"},
 											{ name: "D_RETURNED"},
 											{ name: "D_DUE"},
 											{ name: "FINE_DUE"},
 											{ name: "PAID"},
 											{ name: "BOOKSTAT"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, STUDIDNO: '<?php echo $IDNO; ?>'}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'student_book_grid',
 				height: 200,
 				//width: 900,
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  { header: "Access No.", width: 100, sortable: true, dataIndex: "ACCESSNO" },
 						  { header: "Title", width: 450, sortable: true, dataIndex: "TITLE" },
 						  { header: "Date Borrowed", width: 100, sortable: true, dataIndex: "D_BORROWED" },
 						  { header: "Date Due", width: 100, sortable: true, dataIndex: "D_DUE" },
 						  { header: "Date Returned", width: 100, sortable: true, dataIndex: "D_RETURNED" },
 						  { header: "Fine", width: 100, sortable: true, dataIndex: "FINE_DUE" },
 						  { header: "Paid", width: 100, sortable: true, dataIndex: "PAID" },
 						  { header: "Status", width: 150, sortable: true, dataIndex: "BOOKSTAT", renderer: this.statusFormat }
 						 
 						  
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
                    hiddenName:'book_grid',
                    id: 'bookgrid',
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

                }),{
					xtype:'tbtext',
					text:'Search:'
				},'   ', new Ext.app.SearchField({ store: Objstore, width:250}),
 					    {
 					     	xtype: 'tbfill'
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'VIEW BOOK DETAILS',
							icon: '/images/icons/magnifier.png',
 							cls:'x-btn-text-icon',

 					     	handler: student_borrowing_history.app.ViewBook

 					 	}
 	    			 ]
 	    	});
 	    	
 	    	student_borrowing_history.app.Grid = grid;
 			student_borrowing_history.app.Grid.getStore().load();

 			var _window = new Ext.Panel({
 				title: 'Student Borrowing History',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [student_borrowing_history.app.Grid],
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
 		        labelWidth: 100,
 		        url:"<?=site_url("filereference/addBookType")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Details',
 					width:'auto',
 					height:'auto',
 					defaults: {readOnly: true},
 					items:[
                        {

                    xtype:'textarea',
 		            fieldLabel: 'Book Title',
 		            name: 'TITLE',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'TITLE'
 		        },
 		        {

                    xtype:'textfield',
 		            fieldLabel: 'Access No.',
 		            name: 'ACCESSNO',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'ACCESSNO'
 		        },
 		        {

                    xtype:'textfield',
 		            fieldLabel: 'Call No.',
 		            name: 'CALLNO',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'CALLNO'
 		        },
 		        {

                    xtype:'textfield',
 		            fieldLabel: 'Location',
 		            name: 'LOCATION',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'LOCATION'
 		        },
 		        {

                    xtype:'textfield',
 		            fieldLabel: 'Classification',
 		            name: 'CLASSIFICATION',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'CLASSIFICATION'
 		        },
 		        {

                    xtype:'textfield',
 		            fieldLabel: 'Book Type',
 		            name: 'BOOKTYPE',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'BOOKTYPE'
 		        },
 		        {

                    xtype:'textfield',
 		            fieldLabel: 'Category',
 		            name: 'CATEGORY',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: 'CATEGORY'
 		        }

 		        ]
 					}
 		        ]
 		    });

 		    student_borrowing_history.app.Form = form;
 		},
 		Add: function(){

 			student_borrowing_history.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New Book Type',
 		        width: 510,
 		        height:200,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: student_borrowing_history.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(student_borrowing_history.app.Form)){//check if all forms are filled up

 		                student_borrowing_history.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(student_borrowing_history.app.Grid.getId());
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
 		ViewBook: function(){


 			if(ExtCommon.util.validateSelectionGrid(student_borrowing_history.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = student_borrowing_history.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.ACCESSNO;

 			student_borrowing_history.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'View Book',
 		        width: 510,
 		        height:350,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: student_borrowing_history.app.Form,
 		        buttons: [{
 		            text: 'Close',
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

 		  	student_borrowing_history.app.Form.getForm().load({
 				url: "<?=site_url("book/loadBook")?>",
 				method: 'POST',
 				params: {id: id},
 				timeout: 300000,
 				waitMsg:'Loading...',
 				success: function(form, action){
 									
                                    _window.show();
                                    //Ext.get('CLASIDNO').dom.value = action.result.data.CLASIDNO;
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


			if(ExtCommon.util.validateSelectionGrid(student_borrowing_history.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = student_borrowing_history.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.BOTYIDNO;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("filereference/deleteBookType")?>",
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
							student_borrowing_history.app.Grid.getStore().load({params:{start:0, limit: 25}});

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
		classificationCombo: function(){

 			return {
 				xtype:'combo',
 				id:'CLASSIFICATION',
 				hiddenName: 'CLASIDNO',
                hiddenId: 'CLASIDNO',
 				name: 'CLASSIFICATION',
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
 				//readOnly: true,
 				minListWidth: 300,
 				allowBlank:true,
 				store: new Ext.data.JsonStore({
 				id: 'idsocombo',
 				root: 'data',
 				totalProperty: 'totalCount',
 				fields:[{name: 'id'}, {name: 'name', type:'string', mapping: 'name'}, {name: 'firstname'}, {name: 'middlename'}, {name: 'lastname'}, {name: 'cellphone'}, {name: 'homephone'}, {name: 'memberId'}],
 				url: "<?=site_url("filereference/getClassificationCombo")?>",
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




 				},
 				blur: function(){
 				var val = this.getRawValue();
 				this.setRawValue.defer(1, this, [val]);
 				this.validate();
 				},
 				render: function() {
 				this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a classification'});

 				},
 				keypress: {buffer: 100, fn: function() {
 				Ext.get(this.hiddenName).dom.value  = '';
 				if(!this.getRawValue()){
 				this.doQuery('', true);
 				}
 				}}
 				},
 				fieldLabel: 'Classification*'

 				}
 		},
 		statusFormat: function(val){

			var fmtVal;

			switch(val){
				case "BORROWED"	: 	fmtVal = '<span style="color: blue; font-weight: bold;">'+val+'</span>'; break;
			 	case "RETURNED"	:  	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;
			 	case "OVERDUE"	:  	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;
			 

			}

			return fmtVal;
		}//end of functions
 	}

 }();

 Ext.onReady(student_borrowing_history.app.init, student_borrowing_history.app);

</script>
<div id="mainBody"></div>
