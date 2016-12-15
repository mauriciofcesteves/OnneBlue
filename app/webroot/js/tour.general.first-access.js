var tour = new Tour({
    orphan: true,
    template: "<div class='popover tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><div class='btn-group'><button class='btn btn-primary btn-xs' data-role='prev'><i class='fa fa-arrow-left'></i></button><span data-role='separator'></span><button class='btn btn-primary btn-xs' data-role='next'><i class='fa fa-arrow-right'></i></button></div><button class='btn btn-danger btn-xs' data-role='end'>"+lang.tourEnd+"</button></div></div>"
});
tour.addSteps([
    {
        backdrop: true,
        title: lang.tourStep1title,
        content: lang.tourStep1
    },
    {
        placement: 'bottom',
        element: "#step2",
        title: lang.tourStep2title,
        content: lang.tourStep2,
        onShow: function() {
            $('#bs-example-navbar-collapse-1').addClass('in');
        },
        onHide: function() {
            $('#bs-example-navbar-collapse-1').removeClass('in');
        }
    },
    {
        placement: 'bottom',
        element: "#step3",
        title: lang.tourStep3title,
        content: lang.tourStep3,
        onShow: function() {
            $('#bs-example-navbar-collapse-1').addClass('in');
        },
        onHide: function() {
            $('#bs-example-navbar-collapse-1').removeClass('in');
        }
    },
    {
        placement: 'bottom',
        element: "#step4",
        title: lang.tourStep4title,
        content: lang.tourStep4
    },
    {
        placement: 'top',
        element: "#step5",
        title: lang.tourStep5title,
        content: lang.tourStep5
    },
    {
        placement: 'bottom',
        element: "#step6",
        title: lang.tourStep6title,
        content: lang.tourStep6,
        onShow: function() {
            $('#bs-example-navbar-collapse-1').addClass('in');
        },
        onHide: function() {
            $('#bs-example-navbar-collapse-1').removeClass('in');
        }
    },
]);
tour.restart();