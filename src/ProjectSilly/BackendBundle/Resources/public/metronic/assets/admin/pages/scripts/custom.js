/**
 Custom module for you to write your own javascript functions
 **/
var Custom = function () {

    var initModals = function () {

        var modalDelete = $('#modal-delete');

        $('.btn-delete').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            var href = $(this).data('href');

            modalDelete.find('[data-id]').text(id);
            modalDelete.find('[data-name]').text(name);
            modalDelete.find('form').attr('action', href);
            modalDelete.modal('show');
        });

    };

    var initForm = function () {
        $("select.customSelect").select2();
    };

    var initCustomTable = function () {

        var table = $('#customDataTable');

        // begin first table
        table.dataTable({
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
            },
            "aaSorting": []

        });

        var tableWrapper = jQuery('#sample_1_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    };

    var initInputMasks = function () {

        $('.maskRgi').mask('00000000/00');
        $('.maskCodification').mask('00.000.000.0000.0000.0000.0000', {'removeMaskOnSubmit': true});
        $('.maskDate').mask('00/00/0000');
        $('.maskTime').mask('00:00');
        $('.maskDateTime').mask('00/00/0000 00:00:00');
        $('.maskZipCode').mask('00000-000');
        $('.maskPhone').mask('(00) 0000-0000');
        $('.maskSocialSecurity').mask('000.000.000-00', {
            reverse: true,
            completed: function () {
                this.unmask();
            }
        });

        $('.maskIndividualDocument').mask('99.999.999-S', {
            'translation': {
                9: {pattern: /[0-9]/},
                S: {pattern: /[a-z0-9]/}
            }
        });

        $('.maskCorporateDocument').mask('00.000.000/0000-00', {reverse: true});
        $('.maskMoney').mask('0000000000,00', {reverse: true});

        var maskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };

        $('.maskCell').mask(maskBehavior, options);

        $('form').submit(function () {
            $('.maskRgi').unmask();
            $('.maskCodification').unmask();
            $('.maskZipCode').unmask();
            $('.maskPhone').unmask();
            $('.maskSocialSecurity').unmask();
            $('.maskIndividualDocument').unmask();
            $('.maskCorporateDocument').unmask();
            $('.maskCell').unmask();
        });

    };

    var initReportTable = function () {

        var table = $('#reportDataTable');

        table.dataTable({
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json',
            },
            "pageLength": 30,
            "bFilter": false,
            "bLengthChange": false,
        });

    };

    var initCalculation = function () {

        function autoCalcSetup() {
            $('.jAutoCalc').jAutoCalc('destroy');
            $('.jAutoCalc').jAutoCalc({
                decimalPlaces: 2,
                decimalOpts: [',', '.'],
                thousandOpts: ['', '.', ',']
            });
        }

        autoCalcSetup();
    }

    var initCustomFunctions = function () {


        $('.maskTime').on('focus', function () {
            $(this).select();
        });

        $('.maskMoney').on('focus', function () {
            $(this).select();
        });

        $('.maskMoney').on('blur', function () {
            if ($(this).val() == "" || $(this).val() == 0) {
                $(this).val("0,00");
            }
        });

    }

    return {

        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initForm();
            initModals();
            initCustomTable();
            initReportTable();
            initCalculation();
            initCustomFunctions();
            initInputMasks();
        },

        //some helper function
        doSomeStuff: function () {
            //initTable();
        }

    };

}();