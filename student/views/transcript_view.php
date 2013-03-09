<script type="text/javascript">
 Ext.namespace("ogs_transcript");
 ogs_transcript.app = function()
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
 							url: "<?php echo site_url("student/getTranscript"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
                                                                                        { name: "SUBJCODE"},
 											{ name: "COURSEDESC"},
                                                                                        { name: "UNITS_TTL"},
                                                                                        { name: "DAYS"},
                                                                                        { name: "TIME"},
                                                                                        { name: "ADVISER"},
                                                                                        { name: "ROOM"},
                                                                                        { name: "PRELIM"},
                                                                                        { name: "MIDTERM"},
                                                                                        { name: "FINAL"},
                                                                                        { name: "AVERAGE"},
                                                                                        { name: "REMARKS"},
                                                                                        {name: "SEMESTER"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});



 			var grid = new Ext.grid.GridPanel({
 				id: 'ogs_transcriptgrid',
 				height: 377,
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  { header: "Semester", width: 200, sortable: true, dataIndex: "SEMESTER" },
                                                  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
                                                  { header: "Description", width: 400, sortable: true, dataIndex: "COURSEDESC" },
                                                  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
                                                 // { header: "Prelim", width: 50, sortable: true, dataIndex: "PRELIM", renderer: this.gradeFormat },
                                                 // { header: "Midterm", width: 50, sortable: true, dataIndex: "MIDTERM", renderer: this.gradeFormat },
                                                 // { header: "Final", width: 50, sortable: true, dataIndex: "FINAL", renderer: this.gradeFormat },
                                                  { header: "Final Grade", width: 100, sortable: true, dataIndex: "AVERAGE", renderer: this.gradeFormat }

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

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_transcript.app.Edit();
                        }
                        },
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
 					 	}
 	    			 ]
 	    	});
                /*grid.on("afterrender", function(component) {
                 component.getBottomToolbar().refresh.hideParent = true;
                 component.getBottomToolbar().refresh.hide();
                });*/


 			ogs_transcript.app.Grid = grid;
 			ogs_transcript.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Transcript of Records',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [ogs_transcript.app.Grid],
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
 		        url:"<?=site_url("filereference/addDays")?>",
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
 		            fieldLabel: 'Days*',
                            autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "47"},
 		            name: 'DAYS',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'DAYS'
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

 		    ogs_transcript.app.Form = form;
 		},
 		Add: function(){

 			ogs_transcript.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New Days',
 		        width: 510,
 		        height:230,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: ogs_transcript.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(ogs_transcript.app.Form)){//check if all forms are filled up

 		                ogs_transcript.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(ogs_transcript.app.Grid.getId());
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


 			if(ExtCommon.util.validateSelectionGrid(ogs_transcript.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = ogs_transcript.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.DAYSIDNO;

 			ogs_transcript.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Days',
 		        width: 510,
 		        height:230,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: ogs_transcript.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(ogs_transcript.app.Form)){//check if all forms are filled up
 		                ogs_transcript.app.Form.getForm().submit({
 			                url: "<?=site_url("filereference/updateDays")?>",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(ogs_transcript.app.Grid.getId());
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

 		  	ogs_transcript.app.Form.getForm().load({
 				url: "<?=site_url("filereference/loadDays")?>",
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


			if(ExtCommon.util.validateSelectionGrid(ogs_transcript.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = ogs_transcript.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.DAYSIDNO;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("filereference/deleteDays")?>",
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
							ogs_transcript.app.Grid.getStore().load({params:{start:0, limit: 25}});

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
		remarksFormat: function(val){

			var fmtVal;

			switch(val){
				case "PASSED"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;
			 	case "FAILED"	:  	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;

			}

			return fmtVal;
		},
        gradeFormat: function(val){

			var fmtVal;

			if(val >= 75)
				fmtVal = '<span style="color: blue; font-weight: bold;">'+val+'</span>';
                            else
			 	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>';

			if(val == null)
				fmtVal = '<span style="color: red; font-weight: bold;">0</span>';

			return fmtVal;
		}//end of functions
 	}

 }();

 Ext.onReady(ogs_transcript.app.init, ogs_transcript.app);

</script>
<div id="mainBody"></div>
