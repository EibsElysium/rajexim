var DatatablesExtensionButtons = {
    init: function() {
        var t;
        $("#m_table_1").DataTable({
            responsive: !0,
            dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: ["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"]
        }), 
			t = $("#m_table_2").DataTable({
            responsive: !0,
            order:[],
            stateSave: true,
           // buttons: ["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
            buttons:[
                        {
                            extend: 'print',

                            exportOptions: {columns: ':not(.notexport)'}
                        },
                        {
                            extend: 'copyHtml5',
                            exportOptions: {columns: ':not(.notexport)'}
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {columns: ':not(.notexport)'}
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {columns: ':not(.notexport)'}
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {columns: ':not(.notexport)'}
                        },
                    ]
         }), 
$("#export_print").on("click", function(e) {
            e.preventDefault(), t.button(0).trigger()
        }), $("#export_copy").on("click", function(e) {
            e.preventDefault(), t.button(1).trigger()
        }), $("#export_excel").on("click", function(e) {
            e.preventDefault(), t.button(2).trigger()
        }), $("#export_csv").on("click", function(e) {
            e.preventDefault(), t.button(3).trigger()
        }), $("#export_pdf").on("click", function(e) {
            e.preventDefault(), t.button(4).trigger()
        })
    }
};
jQuery(document).ready(function() {
    DatatablesExtensionButtons.init()
});



