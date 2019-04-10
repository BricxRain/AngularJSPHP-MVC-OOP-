let app = angular.module('homeApp', []);

app.controller('homeController', ($scope, $http) => {

    $scope.button_add_td = true;
    $scope.button_edit_td = false;

    $scope.getAllInformation = () => {
        $http({
            method: "GET",
            url: "get-all-info"
        }).then( (response) => {
            // $scope.alert_div = true;
            // $scope.alert_type = "Success";
            // $scope.alert_message = "Data has been loaded.";
            $scope.information_array = response.data.data;
        });
    };

    $scope.editInfo = (info) => {
        $scope.alert_div = false;
        $scope.button_add_td = false;
        $scope.button_edit_td = true;
        $scope.information = angular.copy(info);
    };

    $scope.cancelInformation = () => {
        $scope.alert_div = false;
        $scope.button_add_td = true;
        $scope.button_edit_td = false;
        $scope.information = {};
    };

    $scope.deleteInfo = (id) => {
        
        $http({
            method: 'DELETE',
            url: 'delete-information',
            data: id
        }).then( (response) => {
            $scope.alert_div = true;
            $scope.alert_type = "Success";
            $scope.alert_message = response.data.data;
            $scope.alert_type_message = "success";
            $scope.getAllInformation();
        });

    };

    $scope.addInformation = () => {
        let status = "INSERT";
        $scope.checkValidInputs($scope.information, status);
    };

    $scope.updateInformation = () => {
        let status = "UPDATE";
        $scope.checkValidInputs($scope.information, status);
    };

    $scope.checkValidInputs = (information, status) => {

        // console.log(information.name);

        let app_name = angular.element(document.querySelector('#infoName'));
        let app_email = angular.element(document.querySelector('#infoEmail'));
        let app_age = angular.element(document.querySelector('#infoAge'));

        if (typeof information !== "undefined") {
            if ( (typeof information.name === "undefined") ||
             (typeof information.email === "undefined") || 
             (typeof information.age === "undefined") ) {

                (typeof information.name === "undefined") ? app_name.addClass('alertBorder') : app_name.removeClass('alertBorder');
                (typeof information.email === "undefined") ? app_email.addClass('alertBorder') : app_email.removeClass('alertBorder');
                (typeof information.age === "undefined") ? app_age.addClass('alertBorder') : app_age.removeClass('alertBorder');

                $scope.alert_div = true;
                $scope.alert_type = "Alert";
                $scope.alert_message = "Please make sure fields are not empty.";
                $scope.alert_type_message = "danger";

            } else {

                app_name.removeClass('alertBorder');
                app_email.removeClass('alertBorder');
                app_age.removeClass('alertBorder');

                $http({
                    method: "POST",
                    url: "insert-update-information",
                    data: {
                        information: information,
                        status: status
                    }
                }).then( (response) => {
                    console.log(response);
                    $scope.alert_div = true;
                    $scope.alert_type = "Success";
                    $scope.alert_message = response.data.data;
                    $scope.alert_type_message = "success";
                    $scope.information = {};
                    $scope.getAllInformation();
                });

            }
        } else {
            app_name.addClass('alertBorder');
            app_email.addClass('alertBorder');
            app_age.addClass('alertBorder');

            $scope.alert_div = true;
            $scope.alert_type = "Alert";
            $scope.alert_message = "Please make sure fields are not empty.";
            $scope.alert_type_message = "danger";

            console.log("Undefined");
        }

    }

});