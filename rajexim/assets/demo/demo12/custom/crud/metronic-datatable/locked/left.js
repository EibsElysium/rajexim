var DefaultDatatableDemo = {
    init: function() {
        $(".left").mDatatable({
            layout: {
                theme: "default",
                class: "",
                scroll: !0,
                height:350,
                footer: !0
            },
            sortable: !1,
            filterable: 1,
            pagination: 1,
            processing:1,
            search: {
                input: $("#generalSearch")
            },

            columns: [{
                field: "Customer Name",
                title: "#", 
                width: 250,
                locked: {
                    left: "xl"
                },
                sortable: !0,
            }]
        })
    }
};
jQuery(document).ready(function() {
    DefaultDatatableDemo.init()
});