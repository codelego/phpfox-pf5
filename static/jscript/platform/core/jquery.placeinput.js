define(['jquery','underscore'],function(){
    var PlaceInput;
    PlaceInput = function (element) {
        var input, autocomplete, outer, stage;

        input = $(element);

        outer = input.closest('.fc-att-location');
        stage = outer.find('.token-ow');

        function clearAddress() {
            stage.html('');
            input.val('').removeClass('disabled').prop('disabled', false);
            outer.find('.cleanup').addClass('hidden');
        }

        input.closest('form').on('clean', clean);

        function clean() {
            stage.html('');
            input.val('').removeClass('disabled').prop('disabled', false);
            outer.addClass('hidden').find('.cleanup').addClass('hidden');
        };

        /**
         *
         * @param obj
         * @returns {*}
         */
        function getLatLng(obj) {
            if (typeof obj.A != 'undefined') {
                return {lat: obj.A, lng: obj.F};
            }

            if (typeof obj.G != 'undefined') {
                return {lat: obj.G, lng: obj.K};
            }

            return {lat: 0.0, lng: 0.0};
        }

        function fillInAddress() {

            var place = autocomplete.getPlace();
            var loc = getLatLng(place.geometry.location)


            console.log(place);

            $('<input type="hidden" name="place[address]">').val(input.val()).appendTo(stage);
            $('<input type="hidden" name="place[google_place_id]">').val(place.place_id).appendTo(stage);
            $('<input type="hidden" name="place[title]">').val(place.name).appendTo(stage);
            $('<input type="hidden" name="place[lat]">').val(loc.lat).appendTo(stage);
            $('<input type="hidden" name="place[lng]">').val(loc.lng).appendTo(stage);
            $('<input type="hidden" name="place[url]">').val(place.url).appendTo(stage);
            $('<input type="hidden" name="place[website]">').val(place.website).appendTo(stage);

            input.prop('disabled', true).addClass('disabled');
            outer.find('.cleanup').removeClass('hidden');
        }

        // load jquery input without the face
        outer.on('click', '[data-toggle="btn-remove-token"]', function () {
            clearAddress();
        });

        function loadDone() {

            autocomplete = new google.maps.places.Autocomplete(input.get(0), {types: ['geocode']});

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                fillInAddress();
            });
        }

        //$.getScript('https://maps.googleapis.com/maps/api/js?libraries=places')
        //    .done(loadDone);

        loadDone();

    };
    window.PlaceInput = PlaceInput;
});