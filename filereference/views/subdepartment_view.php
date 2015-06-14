<div id="mainBody"></div>
<script type="text/javascript">
    Ext.namespace("subdepartment");
    subdepartment.app = function()
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
//                var fields = [{ name: 'id'}, { name: 'description'}, {name: 'dept_type'}];
//                var get_url = "<?php //echo site_url('filereference/Subdepartment/getIndex') ?>//";
//                var sm1 = new Ext.grid.CheckboxSelectionModel({
//                    dataIndex: 'id',
//                    listeners: {
//                        selectionchange: function (sm){
//                            var count = sm.getCount();
//                            if(count == 0){
//                                grid.editButton.disable();
//                                grid.deleteButton.disable();
//                            }else{
//                                grid.deleteButton.enable();
//                                grid.editButton.enable();
//                            }
//
//                            if(sm.getCount() > 1) {
//                                grid.editButton.disable();
//                            }
//                        }
//                    }
//                });
//
//                var column_model = [sm1, {header: "Id", width: 100, sortable: true, dataIndex: 'id'}, {header: "Sub-department", width: 150, sortable: true, dataIndex: 'description'},
//                    {header: "Department", width: 150, sortable: true, dataIndex: 'dept_type'}];
//                var title = 'Sub-department';
//
//                var Objstore = new Ext.data.Store({
//                    proxy: new Ext.data.HttpProxy({
//                        url: get_url,
//                        method: "GET"
//                    }),
//                    reader: new Ext.data.JsonReader({
//                        root: "data",
//                        totalProperty: "totalCount",
//                        fields: fields
//                    }),
//                    remoteSort: true,
//                    baseParams: {start: 0, limit: 25}
//                });
//
//                var colModel = new Ext.grid.ColumnModel(column_model);
//
//                var grid = new Ext.grid.GridPanel({
//                    height: 300,
//                    width: '100%',
//                    border: true,
//                    ds: Objstore,
//                    cm:  colModel,
//                    sm: sm1,
//                    loadMask: true,
//                    bbar:
//                        new Ext.PagingToolbar({
//                            autoShow: true,
//                            pageSize: 25,
//                            store: Objstore,
//                            displayInfo: true,
//                            displayMsg: 'Displaying Results {0} - {1} of {2}',
//                            emptyMsg: "No Data Found."
//                        }),
//                    tbar: [new Ext.form.ComboBox({
//                        fieldLabel: 'Search',
//                        hiddenName:'searchby-form',
//                        id: 'searchby',
//                        typeAhead: true,
//                        triggerAction: 'all',
//                        emptyText:'Search By...',
//                        selectOnFocus:true,
//                        store: new Ext.data.SimpleStore({
//                            id:0
//                            ,fields:
//                                [
//                                    'myId',   //numeric value is the key
//                                    'myText' //the text value is the value
//                                ]
//
//
//                            , data: [['id', 'ID'], ['sd', 'Short Description'], ['ld', 'Long Description']]
//
//                        }),
//                        valueField:'myId',
//                        displayField:'myText',
//                        mode:'local',
//                        width:100,
//                        hidden: true
//
//                    }), {
//                        xtype:'tbtext',
//                        text:'Search:'
//                    },'   ', new Ext.app.SearchField({ store: Objstore, width:250}),
//                        {
//                            xtype: 'tbbutton',
//                            text: 'Clear selections',
//
//                            handler: function(){
//                                subdepartment.app.Grid.getSelectionModel().clearSelections();
//                            }
//
//                        },
//                        {
//                            xtype: 'tbfill'
//                        },{
//                            xtype: 'tbbutton',
//                            text: 'ADD',
//                            icon: '/images/icons/application_add.png',
//                            cls:'x-btn-text-icon',
//                            handler: subdepartment.app.Add
//
//                        },'-',{
//                            xtype: 'tbbutton',
//                            text: 'EDIT',
//                            icon: '/images/icons/application_edit.png',
//                            cls:'x-btn-text-icon',
//                            ref: '../editButton',
//                            disabled: true,
//                            handler: subdepartment.app.Edit
//
//                        },'-',{
//                            xtype: 'tbbutton',
//                            text: 'DELETE',
//                            icon: '/images/icons/application_delete.png',
//                            cls:'x-btn-text-icon',
//                            ref: '../deleteButton',
//                            disabled: true,
//                            handler: subdepartment.app.Delete
//
//                        }
//                    ],
//                    listeners: {
//                        rowdblclick: function(grid, row, e){
//                            subdepartment.app.Edit();
//                        }
//                    }
//                });
                var grid = new Application.filereferencegrid({
                    id: "subdepartment_grid",
                    url: "<?php echo site_url('filereference/Subdepartment/getIndex') ?>",
                    fields: [{ name: 'id'}, { name: 'description'}, {name: 'dept_type'}],
                    columns: [{header: "Id", width: 100, sortable: true, dataIndex: 'id'}, {header: "Sub-department", width: 150, sortable: true, dataIndex: 'description'},
                {header: "Department", width: 150, sortable: true, dataIndex: 'dept_type'}],
                    add: subdepartment.app.Add,
                    edit: subdepartment.app.Edit,
                    delete: subdepartment.app.Delete
                });
                subdepartment.app.Grid = grid;
                subdepartment.app.Grid.getStore().load({params:{start: 0, limit: 25}});

                var _window = new Ext.Panel({
                    title: "Sub-department",
                    width: '100%',
                    height:'auto',
                    renderTo: 'mainBody',
                    draggable: false,
                    layout: 'fit',
                    items: [subdepartment.app.Grid],
                    resizable: false
                });

                _window.render();


            },

            setForm: function(){

                var store_url = "<?php echo site_url('filereference/Subdepartment/store') ?>";

                var form = new Ext.form.FormPanel({
                    labelWidth: 150,
                    url: store_url,
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
                                xtype: 'departmentcombo', id: 'department', anchor: '95%',
                                name: 'department',
                                hiddenId: 'department_id',
                                hiddenName: 'department_id'
                            },
                            {
                                xtype:'textfield',
                                fieldLabel: 'Sub-department*',
                                name: 'description',
                                allowBlank:false,
                                anchor:'95%'
                            }


                        ]
                    }
                    ]
                });

                subdepartment.app.Form = form;
            },

            Add: function(){

                subdepartment.app.setForm();

                var _window;

                _window = new Ext.Window({
                    title: 'New Sub-department',
                    width: 510,
                    height: 180,
                    layout: 'fit',
                    plain:true,
                    modal: true,
                    bodyStyle:'padding:5px;',
                    buttonAlign:'center',
                    items: subdepartment.app.Form,
                    buttons: [{
                        text: 'Save',
                        icon: '/images/icons/disk.png',
                        cls:'x-btn-text-icon',
                        handler: function () {
                            if(ExtCommon.util.validateFormFields(subdepartment.app.Form)){//check if all forms are filled up
                                subdepartment.app.Form.getForm().submit({
                                    success: function(f,action){
                                        Ext.Msg.show({
                                            title: 'Status',
                                            msg: action.result.data,
                                            buttons: Ext.Msg.OK,
                                            icon: Ext.Msg.INFO,
                                            width: '100%'
                                        });
                                        ExtCommon.util.refreshGrid(subdepartment.app.Grid.getId());
                                        _window.destroy();
                                    },
                                    failure: function(f,a){
                                        Ext.Msg.show({
                                            title: 'Error Alert',
                                            msg: a.result.data,
                                            icon: Ext.Msg.ERROR,
                                            buttons: Ext.Msg.OK,
                                            width: '100%'
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
                var update_url = "<?php echo site_url('filereference/Subdepartment/update') ?>";
                var show_url = "<?php echo site_url('filereference/Subdepartment/show') ?>";
                if(ExtCommon.util.validateSelectionGrid(subdepartment.app.Grid.getId())){//check if user has selected an item in the grid
                    var sm = subdepartment.app.Grid.getSelectionModel().getSelections();
                    var id = sm[0].data.id;

                    subdepartment.app.setForm();
                    _window = new Ext.Window({
                        title: 'Update Sub-department',
                        width: 510,
                        height:180,
                        layout: 'fit',
                        plain:true,
                        modal: true,
                        bodyStyle:'padding:5px;',
                        buttonAlign:'center',
                        items: subdepartment.app.Form,
                        buttons: [{
                            text: 'Save',
                            icon: '/images/icons/disk.png',
                            cls:'x-btn-text-icon',
                            handler: function () {
                                if(ExtCommon.util.validateFormFields(subdepartment.app.Form)){//check if all forms are filled up
                                    subdepartment.app.Form.getForm().submit({
                                        url: update_url,
                                        params: {id: id},
                                        method: 'POST',
                                        success: function(f,action){
                                            Ext.Msg.show({
                                                title: 'Status',
                                                msg: action.result.data,
                                                icon: Ext.Msg.INFO,
                                                buttons: Ext.Msg.OK,
                                                width: '100%'
                                            });
                                            ExtCommon.util.refreshGrid(subdepartment.app.Grid.getId());
                                            _window.destroy();
                                        },
                                        failure: function(f,a){
                                            Ext.Msg.show({
                                                title: 'Error Alert',
                                                msg: a.result.data,
                                                icon: Ext.Msg.ERROR,
                                                buttons: Ext.Msg.OK,
                                                width: '100%'
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

                    subdepartment.app.Form.getForm().load({
                        url: show_url,
                        method: 'GET',
                        params: {id: id},
                        timeout: 300000,
                        waitMsg:'Loading...',
                        success: function(form, action){
                            _window.show();
                            Ext.getCmp('department').setRawValue(action.result.data.department_name);

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
                var destroy_url = "<?php echo site_url('filereference/Subdepartment/destroy') ?>";

                if(ExtCommon.util.validateSelectionGrid(subdepartment.app.Grid.getId())){//check if user has selected an item in the grid
                    var sm = subdepartment.app.Grid.getSelectionModel().getSelections();

                    var objectJson = { data: new Array() };

                    for (var key in sm){
                        var tmpJson = Ext.util.JSON.encode(sm[key].data);
                        if(tmpJson != null && typeof(tmpJson) != "undefined" && tmpJson != "null"){
                            objectJson.data.push(sm[key].data.id);
                        }

                    }
                    Ext.Msg.show({
                        title:'Delete Selected',
                        msg: 'Are you sure you want to delete the selected records?',
                        buttons: Ext.Msg.OKCANCEL,
                        fn: function(btn, text){
                            if (btn == 'ok'){
                                Ext.Ajax.request({
                                    url: destroy_url,
                                    params:{ id: Ext.util.JSON.encode(objectJson)},
                                    method: "POST",
                                    timeout:300000000,
                                    success: function(responseObj){
                                        var response = Ext.decode(responseObj.responseText);
                                        if(response.success == true)
                                        {
                                            subdepartment.app.Grid.getStore().load({params:{start:0, limit: 25}});
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

    Ext.onReady(subdepartment.app.init, subdepartment.app);

</script>
