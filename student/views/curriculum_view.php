 <script type="text/javascript" src="/js/ext34/examples/ux/Spinner.js"></script>
 <script type="text/javascript" src="/js/ext34/examples/ux/SpinnerField.js"></script>
 <link rel="stylesheet" type="text/css" href="/js/ext34/examples/ux/css/Spinner.css" />
<script type="text/javascript">
 Ext.namespace("curriculum_setup");
 curriculum_setup.app = function()
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
 							url: "<?=site_url("student/getCurriculumSubjects")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "YEAR"},
 											{ name: "SUBJIDNO"},
 											{ name: "SUBJECT"},
 											{ name: "UNITS"},
 											{ name: "PREREQ"},
 											{ name: "SEMESTER"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'curriculum_subjectgrid',
 				height: 300,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  { header: "Year", width: 200, sortable: true, dataIndex: "YEAR" },
 						  { header: "Subject", width: 400, sortable: true, dataIndex: "SUBJECT" },
 						  { header: "Units (Lab. Units)", width: 100, sortable: true, dataIndex: "UNITS" },
 						  { header: "Pre-requisite", width: 250, sortable: true, dataIndex: "PREREQ" },
 						  { header: "Semester Taken", width: 250, sortable: true, dataIndex: "SEMESTER" }
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
				},'   ', new Ext.app.SearchField({ store: Objstore, width:250})
 	    			 ]
 	    	});

 			curriculum_setup.app.Grid = grid;
 			curriculum_setup.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Student Curriculum',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [curriculum_setup.app.Grid],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });

 	        _window.render();


 		}//end of functions
 	}

 }();

 Ext.onReady(curriculum_setup.app.init, curriculum_setup.app);

</script>
<div id="mainBody"></div>
