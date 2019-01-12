$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function ( e ) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if ( !$item.hasClass('disabled') ) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='number'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for ( var i = 0; i < curInputs.length; i++ ) {
            if ( !curInputs[ i ].validity.valid ) {
                isValid = false;
                $(curInputs[ i ]).closest(".form-group").addClass("has-error");
            }
        }

        if ( isValid )
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

    $('#datepicker').datepicker({
        format: "yyyy-mm-dd"
    });

    $("body").on("submit", ".registration", function ( evt ) {
        var password = $("input[name='password']"),
            confPass = $("input[name='confirm_password']");

        $(".form-group").removeClass("has-error");
        if (password.val().length > 3 && password.val() === confPass.val()) {
            return;
        } else {
            password.closest(".form-group").addClass("has-error");
            confPass.closest(".form-group").addClass("has-error");
        }
        evt.preventDefault();
    });
});
