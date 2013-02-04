<script type="text/javascript">
 Ext.namespace("scaffolding");
 scaffolding.app = function()
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
 							url: "<?php echo site_url("userMatrix/getScaffoldingLog")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
 											{ name: "table_name" },
 											{ name: "date_created" },
 											{ name: "created_by" }
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'scaffoldinggrid',
 				height: 300,
 				width: 900,
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  { header: "Id", dataIndex: "id", width: 75, sortable: true},
 						  { header: "Table Name", width: 100, sortable: true, dataIndex: "table_name" },
                          { header: "Created By", width: 100, sortable: true, dataIndex: "created_by" },
                          { header: "Date Created", width: 100, sortable: true, dataIndex: "date_created" }

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

 					     	handler: scaffolding.app.Add

 					 	}
 	    			 ]
 	    	});

 			scaffolding.app.Grid = grid;
 			scaffolding.app.Grid.getStore().load({params:{start: 0, limit: 25}});


 			var _window = new Ext.Panel({
 		        title: 'Scaffolding',
 		        width: '100%',
 		        height:400,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [scaffolding.app.Grid],
 		        resizable: false
 	        });

 	        _window.render();


 		},
 			setForm: function(){

 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?php echo site_url("userMatrix/generateScaffolding")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
 		        height: 100,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					defaults: {

 				        anchor: '95%',
 				        allowBlank: false
 				      },
 				      defaultType: 'textfield',

 					items:[
 					      {
 				        	fieldLabel: 'Table Name*',
 				        	name: 'table_name',
 				        	id: 'table_name',
 				        	allowBlank: 'false',
 				        	maxLength: 50,
 				        	selectOnFocus: true
 					      }

 		        ]
 					}
 		        ]
 		    });

 		    scaffolding.app.Form = form;
 		},
 		Add: function(){

 			scaffolding.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'Add Table Scaffolding',
 		        width: 410,
 		        height:160,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: scaffolding.app.Form,
 		        buttons: [{
 		         	text: 'Save',
 		         	icon: '/images/icons/disk.png',
					cls:'x-btn-text-icon',
 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(scaffolding.app.Form)){//check if all forms are filled up

 		                scaffolding.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(scaffolding.app.Grid.getId());
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
 		}
	}
}();

 Ext.onReady(scaffolding.app.init, scaffolding.app);

</script>
<div id="mainBody">
</div>