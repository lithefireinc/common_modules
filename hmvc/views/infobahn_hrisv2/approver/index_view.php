<script type="text/javascript">
 Ext.namespace("approver");
 approver.app = function()
 {
 	return{
 		init: function()
 		{
 			ExtCommon.util.init();
 			ExtCommon.util.quickTips();
                        ExtCommon.util.validations();
 			this.getGrid();
 		},
 		getGrid: function()
 		{
ExtCommon.util.renderSearchField('searchby');

 			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("approver/getRecords"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 							{ name: "id"},
							{ name: "description"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, table: "tbl_app_type"}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'leavegrid',
 				height: 422,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[

 						  { header: "Id", width: 100, sortable: true, dataIndex: "id" },
	  					  { header: "Description", width: 250, sortable: true, dataIndex: "description" }
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
 					 	},
                                            /*    {
                                                    xtype: 'tbbutton',
                                                    text: 'ADD',
                                                    icon: '/images/icons/application_add.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.addAppType
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'EDIT',
                                                    handler: approver.app.editAppType
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'DELETE',
                                                    handler: approver.app.deleteAppType
                                                }*/
 	    			 ]
 	    	});

 			approver.app.appTypeGrid = grid;
 			approver.app.appTypeGrid.getStore().load({params:{start: 0, limit: 25}});

 			var appGroupStore = new Ext.data.Store({
					proxy: new Ext.data.HttpProxy({
						url: "<?php echo site_url("approver/getRecords"); ?>",
						method: "POST"
						}),
					reader: new Ext.data.JsonReader({
							root: "data",
							id: "id",
							totalProperty: "totalCount",
							fields: [
							{ name: "id"},
							{ name: "description"}
									]
					}),
					remoteSort: true,
					baseParams: {start: 0, limit: 25, table: "tbl_app_group"}
				});


		var appGroupGrid = new Ext.grid.GridPanel({
			id: 'appGroupGrid',
			height: 422,
			width: '100%',
			border: true,
			ds: appGroupStore,
			cm:  new Ext.grid.ColumnModel(
					[

					  { header: "Id", width: 100, sortable: true, dataIndex: "id" },
	  					  { header: "Description", width: 250, sortable: true, dataIndex: "description" }
					]
			),
		sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
                loadMask: true,
                bbar:
     		new Ext.PagingToolbar({
	        		autoShow: true,
			        pageSize: 25,
			        store: appGroupStore,
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
		},'   ', new Ext.app.SearchField({ store: appGroupStore, width:250}),
				    {
				     	xtype: 'tbfill'
				 	},
                                        {
                                                    xtype: 'tbbutton',
                                                    text: 'ADD',
                                                    icon: '/images/icons/application_add.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.addAppGroup
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'EDIT',
                                                    icon: '/images/icons/application_edit.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.editAppGroup
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'MEMBERS',
                                                    icon: '/images/icons/group.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.showAppGroupMembersGrid
                                                }
 			 ]
 	});

		approver.app.appGroupGrid = appGroupGrid;
		approver.app.appGroupGrid.getStore().load({params:{start: 0, limit: 25}});

                var empGroupStore = new Ext.data.Store({
					proxy: new Ext.data.HttpProxy({
						url: "<?php echo site_url("approver/getRecords"); ?>",
						method: "POST"
						}),
					reader: new Ext.data.JsonReader({
							root: "data",
							id: "id",
							totalProperty: "totalCount",
							fields: [
							{ name: "id"},
							{ name: "description"}
									]
					}),
					remoteSort: true,
					baseParams: {start: 0, limit: 25, table: "tbl_employee_group"}
				});


		var empGroupGrid = new Ext.grid.GridPanel({
			id: 'empGroupGrid',
			height: 422,
			width: '100%',
			border: true,
			ds: empGroupStore,
			cm:  new Ext.grid.ColumnModel(
					[

					  { header: "Id", width: 100, sortable: true, dataIndex: "id" },
	  					  { header: "Description", width: 250, sortable: true, dataIndex: "description" }
					]
			),
		sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
                loadMask: true,
                bbar:
     		new Ext.PagingToolbar({
	        		autoShow: true,
			        pageSize: 25,
			        store: empGroupStore,
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
		},'   ', new Ext.app.SearchField({ store: empGroupStore, width:250}),
				    {
				     	xtype: 'tbfill'
				 	},
                                        {
                                                    xtype: 'tbbutton',
                                                    text: 'ADD',
                                                    icon: '/images/icons/application_add.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.addEmpGroup
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'EDIT',
                                                    icon: '/images/icons/application_edit.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.editEmpGroup
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'MEMBERS',
                                                    icon: '/images/icons/group.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.showEmpGroupMembersGrid
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'APPROVAL FLOW',
                                                    icon: '/images/icons/chart_organisation.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.showApprovalFlowGrid
                                                }
 			 ]
 	});

		approver.app.empGroupGrid = empGroupGrid;
		approver.app.empGroupGrid.getStore().load({params:{start: 0, limit: 25}});

                var appTreeStore = new Ext.data.Store({
					proxy: new Ext.data.HttpProxy({
						url: "<?php echo site_url("approver/getRecords"); ?>",
						method: "POST"
						}),
					reader: new Ext.data.JsonReader({
							root: "data",
							id: "id",
							totalProperty: "totalCount",
							fields: [
							{ name: "id"},
							{ name: "description"}
									]
					}),
					remoteSort: true,
					baseParams: {start: 0, limit: 25, table: "tbl_app_tree"}
				});


		var appTreeGrid = new Ext.grid.GridPanel({
			id: 'appTreeGrid',
			height: 422,
			width: '100%',
			border: true,
			ds: appTreeStore,
			cm:  new Ext.grid.ColumnModel(
					[

					  { header: "Id", width: 100, sortable: true, dataIndex: "id" },
	  					  { header: "Description", width: 250, sortable: true, dataIndex: "description" }
					]
			),
		sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
                loadMask: true,
                bbar:
     		new Ext.PagingToolbar({
	        		autoShow: true,
			        pageSize: 25,
			        store:appTreeStore,
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
		},'   ', new Ext.app.SearchField({ store: appTreeStore, width:250}),
				    {
				     	xtype: 'tbfill'
				 	},
                                        {
                                                    xtype: 'tbbutton',
                                                    text: 'ADD',
                                                    icon: '/images/icons/application_add.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.addAppTree
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'EDIT',
                                                    icon: '/images/icons/application_edit.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.editAppTree
                                                }, '-',
                                                {
                                                    xtype: 'tbbutton',
                                                    text: 'DETAILS',
                                                    icon: '/images/icons/chart_bar.png',  cls:'x-btn-text-icon',
                                                    handler: approver.app.showAppTreeDetailsGrid
                                                }
 			 ]
 	});

		approver.app.appTreeGrid = appTreeGrid;
		approver.app.appTreeGrid.getStore().load({params:{start: 0, limit: 25}});



 			var tabs = new Ext.TabPanel({
		        renderTo: 'mainBody',
		        width:'100%',
		        activeTab: 0,
		        frame:true,
		        height: 450,
                       // layout: 'fit',
		        //defaults:{autoHeight: true},
		        items:[
		            {title: 'Application Type', items: approver.app.appTypeGrid},
		            {title: 'Approver Assignment', items: approver.app.appGroupGrid},
                            {title: 'Employee Assignment', items: [approver.app.empGroupGrid]},
                            {title: 'Approver Setup', items: [approver.app.appTreeGrid]}
		        ]
		    }).render();






 		},
                applyLeave: function(){
                    var LeaveCredits = new Ext.Panel({
				id			: 'panel_leave_credits',
				iconCls		: 'icon_appgroup',
                                split       : true,
                                width       : "100%",
                                layout		: "fit",
                                margins     : '3 0 3 3',
                                html		: ""
			});

                    var form = new Ext.form.FormPanel({
                        labelWidth: 75,
                        url: "<?php echo site_url("leaves/applyLeave")?>",
                        method: 'POST',
                        frame: true,
                        items: [
		        {
                               xtype: 'fieldset',
		               title : 'Leave Information',
		               height : 180,
		               items  : [
		               		{
                                          layout: 'column',
                                          width: 'auto',
                                          items: [
                                              {
                                                  columnWidth: '.5',
                                                  layout: 'form',
                                                  items: [
                                                      {
                                                            xtype: 'datefield',
                                                            name: 'date_from',
                                                            id: 'date_from',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'From',
                                                            anchor: '93%',
                                                            vtype: 'daterange',
                                                            endDateField: 'date_to'
                                                       }
                                                  ]
                                              },
                                              {
                                                  columnWidth: '.5',
                                                  layout: 'form',
                                                  items: [
                                                      {
                                                            xtype: 'datefield',
                                                            name: 'date_to',
                                                            id: 'date_to',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'To',
                                                            anchor: '93%',
                                                            vtype: 'daterange',
                                                            startDateField: 'date_from'
                                                       }
                                                  ]
                                              }
                                          ]
                                        },
		               		{ xtype: 'textfield',
                                          name: 'no_of_days',
                                          id: 'no_of_days',
                                          anchor:'25%',
                                          fieldLabel: 'No of Days',
                                          readOnly: true,
                                          allowBlank: true
                                        },
					{ xtype: 'textarea',
                                          id: 'txtreason',
                                          name: 'reason',
                                          anchor:'90%',
                                          fieldLabel: 'Reason',
                                          allowBlank: false
                                        }
		             	 ]
		              }
		        ]
                    });

                    var fPanel = new Ext.Panel({
				border: false,
			 	region  : 'center',
			 	width: 500,
                                margins : '1 1 1 0',
                                items	: [ form ]
			});

			var applyWinView = new Ext.Window({
					title: "Leave Application",
					width: 900,
					height: 520,
					bodyStyle:'padding:5px;',
					plain: true,
					modal: true,
					layout: 'border',
					items: [ fPanel ],
					buttons: [
							{
							  text: 'Save',
							  icon: '<?php echo base_url(); ?>/images/icons/disk.png',
							},
							{ text: 'Cancel', icon: '<?php echo base_url(); ?>/images/icons/cancel.png',
                                                            disabled: false,
                                                            handler: function(){
                                                                applyWinView.destroy();
                                                            }
                                                        }
						]
			});
                        applyWinView.show();
                }//end of functions
 	