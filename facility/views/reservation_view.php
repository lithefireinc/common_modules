<script type="text/javascript">
 Ext.namespace("reservation");
 reservation.app = function()
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
 							url: "<?=site_url("facility/getReservation")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
 											{ name: "CONFIRMNO"},
 											{ name: "DATEREQUESTED"},
 											{ name: "DATEFROM"},
                                                                                        { name: "DATETO"},
                                                                                        { name: "TIMESTART"},
                                                                                        { name: "TIMEEND"},
                                                                                        { name: "FACIIDNO"},
                                                                                        {name: "FACILITY"},
                                                                                        {name: "STATUS"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'reservationgrid',
 				height: 300,
 				width: 900,
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                         { header: "Confirmation No.", width: 120, sortable: true, dataIndex: "CONFIRMNO" },
 						 { header: "Date Reserved", width: 100, sortable: true, dataIndex: "DATEREQUESTED" },
                         { header: "Date From", width: 100, sortable: true, dataIndex: "DATEFROM" },
                         { header: "Date To", width: 100, sortable: true, dataIndex: "DATETO" },
                         { header: "Facility", width: 300, sortable: true, dataIndex: "FACILITY" },
                         { header: "Time Start", width: 100, sortable: true, dataIndex: "TIMESTART" },
                         { header: "Time End", width: 100, sortable: true, dataIndex: "TIMEEND" },
                         { header: "Status", width: 100, sortable: true, dataIndex: "STATUS", renderer: reservation.app.statusFormat }
                         
                                             
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
 					     	text: 'NEW',
							icon: '/images/icons/add.png',
 							cls:'x-btn-text-icon',

 					     	handler: reservation.app.Add

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'VIEW',
							icon: '/images/icons/magnifier.png',
 							cls:'x-btn-text-icon',

 					     	handler: reservation.app.Edit

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'CANCEL',
							icon: '/images/icons/delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: reservation.app.Delete

 					 	}
 	    			 ]
 	    	});

 			reservation.app.Grid = grid;
 			reservation.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Facility Reservation',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [reservation.app.Grid],
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
 				
 				var store = new Ext.data.JsonStore({
			 		url: "<?php echo site_url("filereference/getFacilityItems"); ?>",
					root: 'data',
					totalProperty: 'totalCount',
					fields: [
								{ name: "ITEMIDNO"},
								{ name: "ITEM"}
									],
                   baseParams: {start: 0, limit: 10}
                });

                var sm1 = new Ext.grid.CheckboxSelectionModel({checkOnly: true,dataIndex: 'ITEMIDNO'});



				var grid = new Ext.grid.GridPanel({
					title: "Selected Items",
					id: 'itemList',
        			height: 213,
					width: 'auto',
					stripeRows: true,
        			border: true,
					layout: "absolute",
					ds: store,
					cm:  new Ext.grid.ColumnModel(
							[
							  sm1,
                              { header: "Item", width: 250, sortable: true, locked:true, dataIndex: "ITEM" }
							]
					),
					selModel: sm1,
		        	loadMask: true,
					tbar: [ 'Search: ', ' ', new Ext.app.SearchField({ store: store, width:320}) ],
					bbar: new Ext.PagingToolbar({
				        		autoShow: true,
						        pageSize: 10,
						        store: store,
						        displayInfo: true,
						        displayMsg: 'Displaying Records {0} - {1} of {2}',
						        emptyMsg: "No Data Found."
						    })
	        	});
	        	
	        	reservation.app.itemGrid = grid;
	        	
	        	
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 100,
 		        id: "reserve_form",
 		        url:"<?=site_url("facility/createReservation")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
				layout: 'form',
 		        items: [
 		        	{
 		        		xtype: "fieldset",
 		        		id: 'reserve_set',
 		        		hiddenId: "reserve_dom",
 		        		items: [
 		        		{
 		        			layout: 'column',
 		        			items: [
 		        				{
 		        					columnWidth: .5,
 		        					layout: 'form',
 		        					items: [
 		        					{
                                                        	xtype: 'textfield',
                                                        	fieldLabel: 'Requested By',
                                                        	id: "REQUESTED_BY",
                                                        	name: "REQUESTED_BY",
                                                        	anchor: '90%',
                                                        	allowBlank: false
                                                       },
 		        					ExtCommon.util.createCombo('FACILITY', 'FACIIDNO', '90%', '<?php echo site_url('filereference/getCombo/FILEFACI/FACIIDNO/FACILITY')?>', 'FACILITY*', false, false),
 		        		{
                                                            xtype: 'datefield',
                                                            name: 'DATEFROM',
                                                            id: 'DATEFROM',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'Date From*',
                                                            allowBlank: false,
                                                            anchor: '90%',
                                                            minValue: new Date(),
                                        //                    msgTarget: 'qtip',
                                                            vtype: 'daterange',
                                                            endDateField: 'DATETO',
                                                            listeners:{
                                                                change: function(){
				                		
                                                            },
                                                                blur: function(){
					                  	
                                                            },
                                                            select: function(){
                                                                
                                                            }
                                                            }
                                                      },
                        {
                                                            xtype: 'datefield',
                                                            name: 'DATETO',
                                                            id: 'DATETO',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'Date To*',
                                                            allowBlank: false,
                                                            minValue: new Date(),
                                                            anchor: '90%',
                                        //                    msgTarget: 'qtip',
                                                            vtype: 'daterange',
                                                            startDateField: 'DATEFROM',
                                                            listeners:{
                                                                change: function(){
				                		
                                                            },
                                                                blur: function(){
					                  	
                                                            },
                                                            select: function(){
                                                                
                                                            }
                                                            }
						},
						{
                                                            xtype: 'timefield',
                                                            fieldLabel: 'Start Time*',
                                                            name: 'TIMESTART',
                                                            id: 'TIMESTART',
                                                            allowBlank: false,
                                                            minValue: '00:00:00',
                                                            maxValue: '23:00:00',
                                                            //value: '08:00:00',
                                                            increment: 30,
                                                            format: 'H:i:s',
                                                            anchor: '90%',
                                                            vtype: 'timerange',
                                                            endTimeField: 'TIMEEND'
                                                        },
                                                        {
                                                            xtype: 'timefield',
                                                            fieldLabel: 'End Time*',
                                                            name: 'TIMEEND',
                                                            id: 'TIMEEND',
                                                            allowBlank: false,
                                                            minValue: '00:00:00',
                                                            maxValue: '23:00:00',
                                                            //value: '08:00:00',
                                                            increment: 30,
                                                            format: 'H:i:s',
                                                            anchor: '90%',
                                                            vtype: 'timerange',
                                                            startTimeField: 'TIMESTART'
                                                        },
                                                        {
                                                        	xtype: 'textarea',
                                                        	fieldLabel: 'Purpose*',
                                                        	id: "PURPOSE",
                                                        	name: "PURPOSE",
                                                        	anchor: '90%',
                                                        	allowBlank: false
                                                        }
 		        					]
 		        				},
 		        				{
 		        					columnWidth: .5,
 		        					layout: form,
 		        					items: grid
 		        				}
 		        			]
 		        		}
 		        		 		        	
 		        ]
 		        },
 		        {
 		        	xtype: 'textarea',
 		        	name: 'REASON',
 		        	id: 'REASON',
 		        	allowBlank: false,
 		        	fieldLabel: 'Remarks*',
 		        	anchor: '93%'
 		        }
 		        ]
 		    });

 		    reservation.app.Form = form;
 		    //grid.getStore().load();
 		},
 		Add: function(){

 			reservation.app.setForm();
			reservation.app.itemGrid.getStore().load();
 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'Create Reservation',
 		        width: 500,
 		        height:490,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: reservation.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(reservation.app.Form)){//check if all forms are filled up

								var selectedItemsJson = Ext.getCmp("itemList").getSelectionModel().getSelections();

								var objectJson = { data: new Array() };

									for (var key in selectedItemsJson){

							    		tmpJson = Ext.util.JSON.encode(selectedItemsJson[key].data);

										if(tmpJson != null && typeof(tmpJson) != "undefined" && tmpJson != "null"){

											objectJson.data.push(selectedItemsJson[key].data.ITEMIDNO);

										}

						    		}
 		                reservation.app.Form.getForm().submit({
 		                	params: {items: Ext.util.JSON.encode(objectJson)},
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(reservation.app.Grid.getId());
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


 			if(ExtCommon.util.validateSelectionGrid(reservation.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = reservation.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.CONFIRMNO;
 			var reservation_id = sm.getSelected().data.id;

 			reservation.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'View Reservation',
 		        width: 800,
 		        height:410,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: reservation.app.Form,
 		        buttons: [{
 		            text: 'Close',
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

 		  	reservation.app.Form.getForm().load({
 				url: "<?=site_url("facility/loadReservation")?>",
 				method: 'POST',
 				params: {id: id},
 				timeout: 300000,
 				waitMsg:'Loading...',
 				success: function(form, action){
 					
 								Ext.getCmp("DATETO").setValue("");
 								Ext.getCmp("TIMEEND").setValue("");
                                    _window.show();
                              //      Ext.apply(Ext.getCmp('reserve_set'), {readOnly: true});
                              Ext.getCmp("DATETO").setValue(action.result.data.DATETO);
 								Ext.getCmp("TIMEEND").setValue(action.result.data.TIMEEND);
 								Ext.getCmp("DATETO").setReadOnly(true);
 								Ext.getCmp("FACILITY").setReadOnly(true);
 								Ext.getCmp("DATEFROM").setReadOnly(true);
 								Ext.getCmp("TIMESTART").setReadOnly(true);
 								Ext.getCmp("TIMEEND").setReadOnly(true);
 								Ext.getCmp("PURPOSE").setReadOnly(true);
                              reservation.app.itemGrid.getStore().proxy.conn.url = "<?=site_url("facility/loadReservedItems")?>";
                              reservation.app.itemGrid.getStore().load({params: {reservation_id: reservation_id}});      
                                    
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


			if(ExtCommon.util.validateSelectionGrid(reservation.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = reservation.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.CONFIRMNO;
			Ext.Msg.show({
   			title:'Cancel Reservation',
  			msg: 'Are you sure you want to cancel this reservation?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("facility/cancelReservation")?>",
							params:{ id: id},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							Ext.Msg.show({
								title: 'Status',
								msg: response.msg,
								icon: Ext.Msg.INFO,
								buttons: Ext.Msg.OK
							});
							reservation.app.Grid.getStore().load({params:{start:0, limit: 25}});

							return;

						}
						else if(response.success == false)
						{
							Ext.Msg.show({
								title: 'Error!',
								msg: response.data,
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
        studentLevelCombo: function(){

		return {
			xtype:'combo',
			id:'YEAR',
			//hiddenName: 'COURIDNO',
			name: 'YEAR',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '93%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: true,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("filereference/getStudentLevelCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.getCmp(this.id).setValue(record.get('name'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a course'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Year Level'

			}
	},
        schoolCombo: function(){

		return {
			xtype:'combo',
			id:'IDNO',
			//hiddenName: 'COURIDNO',
			name: 'IDNO',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '93%',
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
			url: "<?php echo site_url("filereference/getSchoolCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.getCmp(this.id).setValue(record.get('name'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a school'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'School*'

			}
	},
        sectionCombo: function(){

		return {
			xtype:'combo',
			id:'SECTION',
			//hiddenName: 'COURIDNO',
			name: 'SECTION',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '93%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: true,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("filereference/getSectionCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.getCmp(this.id).setValue(record.get('name'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a school'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Section'

			}
	},
        roomCombo: function(){

		return {
			xtype:'combo',
			id:'ROOM',
			//hiddenName: 'COURIDNO',
			name: 'ROOM',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '93%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: true,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("filereference/getRoomCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.getCmp(this.id).setValue(record.get('name'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a school'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Room'

			}
	},
	statusFormat: function(val){

			var fmtVal;

			switch(val){
				case "Approved"	: 	fmtVal = '<span style="color: blue; font-weight: bold;">'+val+'</span>'; break;
			 	case "Denied"	:  	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;
			 	case "Cancelled": 	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;
			 	case "Pending"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;
				case "Recalled" : fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;
				case "System Void"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;

			}

			return fmtVal;
		}//end of functions
 	}

 }();

 Ext.onReady(reservation.app.init, reservation.app);

</script>
<div id="mainBody"></div>
