var global = function () {
    var hlp_dtrp = function(tipe,clas,prm){
        // 1 = datepicker, 2 = datettimepicker, 3 = timepicker, 4 = rangepicker

        if(tipe == '1'){
            $(clas).datepicker(prm);
        }else if(tipe == '2'){
            $(clas).datetimepicker(prm);
        }else if(tipe == '3'){
            $(clas).timepicker(prm);
        }else{
            $(clas).daterangepicker(prm,function(start, end, label) {
                $(clas + ' .form-control').val( start.format(prm.format) + ' - ' + end.format(prm.format));
            });
        }
    }

    var hlp_select2 = function(clas,url,clear,tag){
        var Dtag = (typeof tag == "undefined" || tag == false  ? false : true); 
        var Dclr = (typeof clear == "undefined" ? false : true); 

        $( clas ).select2({
            minimumInputLength : 2,
            allowClear         : Dclr,
		    ajax: {
		        url         : base_url + url,
		        dataType    : 'json',
		        quietMillis : 250,
		        data: function (term, page) {
		            return {
		                key : term,
		            };
		        },
		        results: function (data, page) {
		            return { results : data.item };
		        },
		        cache: true
		    },
		    initSelection: function(element, callback) {
		    	var id = $(element).val();
		        if (id !== "") {
		            $.ajax(base_url + url + "/" + id, {
		                dataType: "json"
		            }).done( function(data) { callback(data[0]); });
		        }
		    },
		    formatResult    : formatResult,
    		formatSelection : formatResult,
        });
    }

    function formatResult(state){
	    var data = state.name;
	 
	    return data;
    }
    
    var hlp_datatableAjax = function(id, baseUrl, header, order, sort){
        var grid = new Datatable();

        grid.init({
            src: $(id),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
                $('.tooltips').tooltip();
            },
            dataTable: {
                "aoColumns": header,
                "bStateSave": true,
                "pageLength": 10,
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "ajax": {
                    "url": baseUrl
                },
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": sort }
                ],
                "fnStateSaveParams": function (oSettings, oData) {
                    $('.form-filter').each(function(index, el) {
                        var name = $(el).attr('name');
                        var val = $(el).val();

                        if($(this).val() != ''){
                            oData[name] = val;
                        }
                    });

                    var data_status = $('.datatable select[name="status"]').val();
                    oData['data-status']    = data_status;

                    localStorage.setItem( 'DataTables_datatable_ajax_'+window.location.pathname, JSON.stringify(oData) );
                },
                "fnStateLoadParams": function(){
                    var filter = false;
                    var data = JSON.parse( localStorage.getItem('DataTables_datatable_ajax_'+window.location.pathname) );
                    $('.form-filter').each(function(){
                        var name = $(this).attr('name');
                        if(data[name] !== undefined){
                            $(this).val(data[name]);
                            filter = true;
                        }
                    });

                    if(filter){
                        $('.datatable_ajax .filter').show();
                    }

                    var data_status = data['data-status'];
                    $('.datatable select[name="status"]').val(data_status);

                },
                "order": order
            }
        });

        grid.getTableWrapper().on('keyup', '.form-filter', function (e) {
            if(e.keyCode == 13){
                $('.filter-submit').trigger('click');
            }
        });

        $('.datatable').on('change', 'select[name="status"]', function () {
            var val = $(this).val();
            grid.setAjaxParam("data-status", val);
            grid.getDataTable().ajax.reload();
        })

        grid.getTableWrapper().on('change', '.select-filter', function (e) {
            $('.filter-submit').trigger('click');
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                var message = 'Default Message';
                var message_success = 'Default Success Message';

                if(action.val() == '0'){
                    message = 'Are you sure want to Deactive Data ?';
                    message_success = 'Your data has successfully Deactivated ?';
                }else if(action.val() == '1'){
                    message = 'Are you sure want to Activate Data ?';
                    message_success = 'Your data has successfully Activate ?';
                }else if(action.val() == '99'){
                    message = 'Are you sure want to Delete Data ?';
                    message_success = 'Your data has successfully Deleted ?';
                }else if(action.val() == '98'){
                    message = 'Are you sure want to Delete Permanent Data ?';
                    message_success = 'Your data has successfully Deleted ?';
                }

                swal({
                    title: "Are you sure?",
                    text: message,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    closeOnConfirm: false
                },
                function(){
                    grid.setAjaxParam("customActionType", "group_action");
                    grid.setAjaxParam("customActionName", action.val());
                    grid.setAjaxParam("id", grid.getSelectedRows());
                    grid.getDataTable().ajax.reload();
                    grid.clearAjaxParams();
                    swal("Success", message_success, "success");
                });
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        gridT = grid;
    }

    return {
        init_dtrp    : function (tipe,clas,prm) { hlp_dtrp(tipe,clas,prm) },
        init_select2 : function(clas,url,clear,tag) { hlp_select2(clas,url,clear,tag) },
        init_da      : function(id, baseUrl, header, order, sort) { hlp_datatableAjax(id, baseUrl, header, order, sort) }
    };
}();
